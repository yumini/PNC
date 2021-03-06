<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Evaluador;
use App\WebBundle\Form\EvaluadorType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Evaluador controller.
 *
 * @Route("/admin/evaluador")
 */
class EvaluadorController extends Controller
{

    /**
     * Lists all Evaluador entities.
     *
     * @Route("/", name="_admin_evaluador", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $field=$this->get('request')->query->get('filterField', 'u.username');
        $value=$this->get('request')->query->get('filterValue','');
        $sort=$this->get('request')->query->get('sort', 'u.username');

        $paginator=$this->get('knp_paginator');
        $dql   = "SELECT e FROM AppWebBundle:Evaluador e join e.usuario u
                where $field like '%$value%' order by $sort asc";
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query,$page,10);

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Evaluadores",
            'action'=> "evaluador"
        );
    }
    /**
     * Creates a new Evaluador entity.
     *
     * @Route("/", name="evaluador_create")
     * @Method("POST")
     * @Template("AppWebBundle:Evaluador:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Evaluador();
        $form = $this->createForm(new EvaluadorType(), $entity);
        $form->bind($request);
        $user = $this->container->get("security.context")->getToken()->getUser();
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUsuario($user);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evaluador_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Evaluador entity.
     *
     * @Route("/new", name="evaluador_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Evaluador();
        $form   = $this->createForm(new EvaluadorType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Postulante entity.
     *
     * @Route("/{id}/perfil", name="_admin_evaluador_perfil", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function perfilAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Evaluador')->find($id);
       
        return array(
            'entity'      => $entity
        );
    }
    /**
     * Finds and displays a Evaluador entity.
     *
     * @Route("/{id}", name="evaluador_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Evaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evaluador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

     /**
     * Displays a form to edit an existing Postulante entity.
     *
     * @Route("/{id}/edit", name="_admin_evaluador_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Evaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evaluador entity.');
        }

        $editForm = $this->createForm(new EvaluadorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing Postulante entity.
     *
     * @Route("/{id}/update", name="_admin_evaluador_update", options={"expose"=true})
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Evaluador')->find($id);
        $editForm = $this->createForm(new EvaluadorType(), $entity);
        $editForm->bind($request);

        $errors = $this->get('validator')->validate($editForm);
        if (count($errors)==0 && $editForm->isValid()) {
            if ($entity) {
               
                $em->persist($entity);
                $em->flush();
                $success=true;
                $msg="Perfil evaluador actualizado satisfactoriamente";
            }else{
                $success=false;
                $msg="No se ha encontrado el evaluador";

            }
        }else{
             $msgError=new \App\WebBundle\Util\MensajeError();
             $msgError->AddErrors($editForm);
             $msg=$msgError->getErrorsHTML();
             $success=false;
        }
        return new JsonResponse(array(
            'success' =>$success ,
            'message'=> $msg
        ));
        
    }
    /**
     * Deletes a Evaluador entity.
     *
     * @Route("/{id}", name="evaluador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:Evaluador')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Evaluador entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('evaluador'));
    }

    /**
     * Creates a form to delete a Evaluador entity by id.
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
    
    /**
     *
     * @Route("/upload/evaluador/cv/{id}", name="_admin_evaluador_cvupload", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function uploadCVAction(Request $request,$id)
    {
      
       //$id=$request->request->get('evaluador_id');
       $msg='Curriculum se actualizó satisfactoriamente';
       $fileName='';
       $success=false;
       $em = $this->getDoctrine()->getManager(); 
       $entity = $em->getRepository('AppWebBundle:Evaluador')->find($id); 
       $allowed = array('pdf', 'doc', 'docx');
       
       
       if(isset($_FILES['fileCV']) && $_FILES['fileCV']['error'] == 0){
       
            $extension = pathinfo($_FILES['fileCV']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($extension), $allowed)){
               $success=false;
               $msg="Formato de archivo no valido";
            }else{
                $fileName='cv-'.$id.'.'.$extension;
                if(move_uploaded_file($_FILES['fileCV']['tmp_name'], 'docs/evaluador/cv/'.$fileName)){
                    $em = $this->getDoctrine()->getManager();
                    $entity->setCurriculum($fileName);
                    $em->persist($entity);
                    $em->flush();
                    $success=true;
                    //$msg="Archivo se cargo satisfactoriamente";
                }
            }
       
        }else{
            $success=false;
            $msg="Ocurrio un error. No se pudo cargar el archivo".$_FILES['fileCV']['error'];
        }
       
        return new JsonResponse(array('success'=>$success,'message'=>$msg,'name'=>$fileName));
        
    }

    /**
     *
     * @Route("/report/evaluador", name="_admin_evaluador_report", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function reportAction(Request $request)
    {
        set_time_limit(300);
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:Evaluador')->findAll();

        $content = $this->renderView('AppWebBundle:Evaluador:report.html.twig',array(
            'title_list'=> "Listado de Evaluadores",
            'entities'=>$entities
        ));
        return new Response(
            ($content),
            200,
            array(
                'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
                'Content-Disposition' => 'attachment; filename="evaluadores.xls"',
                'Content-Length' => strlen($content)
            )
        );
     
    }
}
