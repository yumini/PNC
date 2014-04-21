<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Inscripcion;
use App\WebBundle\Form\InscripcionType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Inscripcion controller.
 *
 * @Route("/admin/inscripcion")
 */
class InscripcionController extends Controller
{

    /**
     * Lists all Inscripcion entities.
     *
     * @Route("/", name="inscripcion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:Inscripcion')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all GrupoEvaluacionPostulante entities.
     *
     * @Route("/json/rest", name="_admin_json_inscripcion", options={"expose"=true})
     * @Method("GET")
     */
    public function json_indexAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $concurso_id=$request->query->get('concurso_id');
        $postulante_id=$request->query->get('postulante_id');

        $entities = $em->getRepository('AppWebBundle:Inscripcion')
            ->findByConcursoAndPostulante($concurso_id,$postulante_id,true);
        
        return new JsonResponse($entities);
    }

    /**
     * Creates a new Inscripcion entity.
     *
     * @Route("/{id}/save/{id2}", name="_admin_inscripcion_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request,$id,$id2)
    {
        
        $entity  = new Inscripcion();
        $form = $this->createForm(new InscripcionType(), $entity);
        $form->bind($request);
        $msg="Inscripción realizada satisfactoriamente";
        $errors = $this->get('validator')->validate($form);
        if (count($errors)==0 && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $postulante = $em->getRepository('AppWebBundle:Postulante')->find($id);
            $concurso=$em->getRepository('AppWebBundle:Concurso')->find($id2);
            
            $entity->setConcurso($concurso);
            $entity->setPostulante($postulante);
            $em->persist($entity);
            $em->flush();
            $success=true;
            $id=$entity->getId();
        }else{
             $msgError=new \App\WebBundle\Util\MensajeError();
             $msgError->AddErrors($form);
             $msg=$msgError->getErrorsHTML();
             $success=false;
             $id=0;
        }
        return new JsonResponse(array(
            'result' =>true ,
            'id'=> $id,
            'success' =>$success ,
            'message'=> $msg
        ));
    }

    /**
     * Creates a new Inscripcion entity.
     *
     * @Route("/upload/new", name="_admin_inscripcion_upload", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function uploadAction(Request $request)
    {
        $type=$request->request->get('typeFile');
        $id=$request->request->get('idInscripcion');
        
       $em = $this->getDoctrine()->getManager();
       $entity = $em->getRepository('AppWebBundle:Inscripcion')->find($id);
       $allowed = array('doc', 'docx', 'pdf','zip');
       if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($extension), $allowed)){
               $result="error";
            }
            $pathDir=$id;
            $filename="informe-$type.$extension";
            switch ($type) {
                case 'completo':
                    $entity->setInformepostulacionc($filename);
                    break;
                
                case 'sinnformacionconfidencial':
                    $entity->setInformepostulacionsic($filename);
                    break;
            }
            $em->persist($entity);
            $em->flush();
            if (!is_dir('uploads/informes/'.$pathDir)) {
                @mkdir('uploads/informes/'.$pathDir);
            }
            if(move_uploaded_file($_FILES['upl']['tmp_name'], "uploads/informes/$pathDir/".$filename)){
               $result="success";
            }
        }

        return array(
            'result' => "{status:$result}"
        );
    }


    /**
     * Displays a form to create a new Inscripcion entity.
     *
     * @Route("/{id}/new/{id2}", name="_admin_inscripcion_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction($id,$id2)
    {
        $showProyect=true;
        $em = $this->getDoctrine()->getManager();
        $entity = new Inscripcion();
        $form   = $this->createForm(new InscripcionType(), $entity);
        $concurso=$em->getRepository('AppWebBundle:Concurso')->find($id2);
        $tipoConcurso=$concurso->getTipoConcurso();
        if($tipoConcurso->getCodigo()==1)
                $showProyect=false;
        
        return array(
            'showProyect'=>$showProyect,
            'entity' => $entity,
            'form'   => $form->createView(),
            'concurso'=>$concurso
        );
    }

    /**
     * Finds and displays a Inscripcion entity.
     *
     * @Route("/{id}", name="inscripcion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Inscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscripcion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Inscripcion entity.
     *
     * @Route("/{id}/edit", name="_admin_inscripcion_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $showProyect=true;
        $entity = $em->getRepository('AppWebBundle:Inscripcion')->find($id);
        $tipoConcurso=$entity->getConcurso()->getTipoConcurso();
        if($tipoConcurso->getCodigo()==1)
                $showProyect=false;

        $editForm = $this->createForm(new InscripcionType(), $entity);
        return array(
            'showProyect'=>$showProyect,
            'entity'      => $entity,
            'concurso'=>$entity->getConcurso(),
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing Inscripcion entity.
     *
     * @Route("/{id}", name="_admin_inscripcion_update", options={"expose"=true})
     * @Method("PUT")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Inscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscripcion entity.');
        }


        $editForm = $this->createForm(new InscripcionType(), $entity);
        $editForm->bind($request);

        //if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
        //}

        return array(
            'result' => "{success:true}"
        );
    }
    /**
     * Deletes a Inscripcion entity.
     *
     * @Route("/{id}", name="_admin_inscripcion_delete", options={"expose"=true})
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

      
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:Inscripcion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Inscripcion entity.');
            }

            $em->remove($entity);
            $em->flush();
      

        return new JsonResponse(array('success'=>true));
    }

    /**
     * Creates a form to delete a Inscripcion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
