<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\ConcursoCriterio;
use App\WebBundle\Form\ConcursoCriterioType;
use App\WebBundle\Form\ConcursoSubcriterioType;
use App\WebBundle\Form\ConcursoAreaAnalisisType;
use App\WebBundle\Form\ConcursoPreguntaType;
use App\WebBundle\Services\ConcursoCriterioService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * ConcursoCriterio controller.
 *
 * @Route("/admin/concursocriterio")
 */
class ConcursoCriterioController extends Controller
{

     /**
     * @Route("/tree/{id}", name="_admin_concurso_criterio_json", options={"expose"=true})
     * @Method("GET")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function treeAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $nivel=$request->query->get('nivel');
        $service=new ConcursoCriterioService($em);
        $json=$service->GetTreeJSON($id,$nivel);

        return array(
            'result' => $json
            );
    }

    /**
     * @Route("/json/rest", name="_admin_json_concurso_criterio", options={"expose"=true})
     * @Method("GET")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function json_indexAction(Request $request)
    {
        $id=$request->query->get('concurso_id');
        $em = $this->getDoctrine()->getManager();
        
        $entities=$em->getRepository('AppWebBundle:ConcursoCriterio')->FindByConcurso($id,true);
        return new JsonResponse($entities);
    }

    /**
     * @Route("/json/rest/{id}", name="_admin_json_concursocriterio_show", options={"expose"=true})
     * @Method("GET")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function json_showAction(Request $request,$id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $entity=$em->getRepository("AppWebBundle:ConcursoCriterio")->find($id);
        $entityArray=$em->getRepository("AppWebBundle:ConcursoCriterio")->findArray($id);
        $entities=$em->getRepository('AppWebBundle:ConcursoCriterio')->FindByParentId($entity->getConcurso()->getId(),$id,true);
        $entityArray[0]['children']=$entities;
        return new JsonResponse($entityArray[0]);
    }
    /**
     * Lists all ConcursoCriterio entities.
     *
     * @Route("/{id}", name="_admin_concurso_criterio", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:ConcursoCriterio')->FindByConcursoOrderByParent($id);
        $concurso= $em->getRepository('AppWebBundle:Concurso')->find($id);
        return array(
            'title_list'=> "Listado de Criterios",
            'concurso'=>$concurso,
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ConcursoCriterio entity.
     *
     * @Route("/{id}/save", name="_admin_concursocriterio_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request,$id)
    {
        //$id=$request->request->get('id');
        $idPadre=$request->request->get('idPadre');
        $em = $this->getDoctrine()->getManager();
        $criteriopadre = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($idPadre);

        
        $concurso = $em->getRepository('AppWebBundle:Concurso')->find($id);

         if($idPadre!=0)
            $tipoArbolCodigo=$criteriopadre->getTipoArbolCriterio()->getCodigo()+1;
        else
            $tipoArbolCodigo=1;

        $tipoArbol= $em->getRepository('AppWebBundle:Catalogo')->getCatalogoByCodigo("TIPOARBOLCRITERIO",$tipoArbolCodigo);
        $entity  = new ConcursoCriterio();
        switch ($tipoArbolCodigo) {
            case '1':
                    $form   = $this->createForm(new ConcursoCriterioType(), $entity);
                break;
            case '2':
                    $form   = $this->createForm(new ConcursoSubcriterioType(), $entity);
                break;            
            case '3':
                $form   = $this->createForm(new ConcursoAreaAnalisisType(), $entity);
                break;
            case '4':
                $form   = $this->createForm(new ConcursoPreguntaType(), $entity);
                break;
        }

        $form->bind($request);
        $msg='';
        $errors = $this->get('validator')->validate($form);
        if (count($errors)==0 && $form->isValid()) {
            $entity->setConcurso($concurso);
            $entity->setidpadre($idPadre);
            $entity->setTipoArbolCriterio($tipoArbol);
            $em->persist($entity);
            $em->flush();
            $msg="registro guardado satisfactoriamente";
            $success=true;  
        }else{
             $msgError=new \App\WebBundle\Util\MensajeError();
             $msgError->AddErrors($form);
             $msg=$msgError->getErrorsHTML();
             $success=false;
        }

        return new JsonResponse(array(
            'success' =>$success ,
            'message'=> $msg
        ));
       
    }

    /**
     * Displays a form to create a new ConcursoCriterio entity.
     *
     * @Route("/{id}/new", name="_admin_concursocriterio_new", options={"expose"=true})
     * @Method("GET")
     * @Template("AppWebBundle:ConcursoCriterio:new.html.twig")
     */
    public function newAction(Request $request,$id)
    {
        
        $idPadre=$request->query->get('idPadre');
        $em = $this->getDoctrine()->getManager();
        $entity = new ConcursoCriterio();
        $criterio = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($idPadre);
        $template="";
        if($idPadre!=0)
            $tipoArbol=$criterio->getTipoArbolCriterio()->getCodigo()+1;
        else
            $tipoArbol=1;

        switch ($tipoArbol) {
            case '1':
                 $form   = $this->createForm(new ConcursoCriterioType(), $entity);
                 $template="AppWebBundle:ConcursoCriterio:new.html.twig";
                 $entityPadre=null;
                break;
            case '2':
                 $form   = $this->createForm(new ConcursoSubcriterioType(), $entity);
                  $template="AppWebBundle:ConcursoCriterio:new2.html.twig";
                  $entityPadre=$criterio;
                break;            
            case '3':
                $form   = $this->createForm(new ConcursoAreaAnalisisType(), $entity);
                $template="AppWebBundle:ConcursoCriterio:new3.html.twig";
                $entityPadre=$criterio;
                break;
            case '4':
                $form   = $this->createForm(new ConcursoPreguntaType(), $entity);
                $template="AppWebBundle:ConcursoCriterio:new4.html.twig";
                $entityPadre=$criterio;
                break;
        }
       
        return $this->render($template,array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'entityPadre'=> $entityPadre 
        ));
        
    }

    
    /**
     * Finds and displays a ConcursoCriterio entity.
     *
     * @Route("/{id}", name="concursocriterio_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ConcursoCriterio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ConcursoCriterio entity.
     *
     * @Route("/{id}/edit", name="_admin_concursocriterio_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($id);        

        $template="";
        $tipoArbol=$entity->getTipoArbolCriterio()->getCodigo();

        switch ($tipoArbol) {
            case '1':
                 $form   = $this->createForm(new ConcursoCriterioType(), $entity);
                 $template="AppWebBundle:ConcursoCriterio:edit.html.twig";
                 $entityPadre=null;
                break;
            case '2':
                 $form   = $this->createForm(new ConcursoSubcriterioType(), $entity);
                  $template="AppWebBundle:ConcursoCriterio:edit2.html.twig";
                  $entityPadre= $em->getRepository('AppWebBundle:ConcursoCriterio')->find($entity->getidpadre()); 
                break;            
            case '3':
                $form   = $this->createForm(new ConcursoAreaAnalisisType(), $entity);
                $template="AppWebBundle:ConcursoCriterio:edit3.html.twig";
                $entityPadre= $em->getRepository('AppWebBundle:ConcursoCriterio')->find($entity->getidpadre()); 
                break;
            case '4':
                $form   = $this->createForm(new ConcursoPreguntaType(), $entity);
                $template="AppWebBundle:ConcursoCriterio:edit4.html.twig";
                $entityPadre= $em->getRepository('AppWebBundle:ConcursoCriterio')->find($entity->getidpadre()); 
                break;
        }
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Concurso entity.');
        }

       return $this->render($template,array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'entityPadre'=> $entityPadre 
        ));
    }

    /**
     * Edits an existing ConcursoCriterio entity.
     *
     * @Route("/{id}/update", name="_admin_concursocriterio_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($id);
        $tipoArbol=$entity->getTipoArbolCriterio()->getCodigo();

        switch ($tipoArbol) {
            case '1':
                $form= $this->createForm(new ConcursoCriterioType(), $entity);
                break;
            case '2':
                 $form= $this->createForm(new ConcursoSubcriterioType(), $entity);
                break;            
            case '3':
                $form= $this->createForm(new ConcursoAreaAnalisisType(), $entity);
                break;
            case '4':
                $form= $this->createForm(new ConcursoPreguntaType(), $entity);
                break;
        }
        $success=false;
        $form->bind($request);
        $msg='';
        $errors = $this->get('validator')->validate($form);
        if (count($errors)==0 && $form->isValid()) {
            if ($entity) {
               
                $em->persist($entity);
                $em->flush();
                $success=true;
                $msg="Registro actualizado satisfactoriamente";
            }else{
                $success=false;
                $msg="elemento no encontrado";

            }
        }else{
             $msgError=new \App\WebBundle\Util\MensajeError();
             $msgError->AddErrors($form);
             $msg=$msgError->getErrorsHTML();
             $success=false;
        }

        return new JsonResponse(array(
            'success' =>$success ,
            'message'=> $msg
        ));

       
    }
    /**
     * Deletes a ConcursoCriterio entity.
     *
     * @Route("/{id}/delete", name="_admin_concursocriterio_delete", options={"expose"=true})
     * @Method("DELETE")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function deleteAction(Request $request, $id)
    {
            $msg="Se elimino el registro satisfactoriamente";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            try {
                $em->getRepository('AppWebBundle:ConcursoCriterio')->Remove($id);
            } catch (Exception $e) {
                $msg=$e->getMessage(); 
                $result=false;
               
            }
            return array(
            'result' => "{\"success:\"$result\",\"message\":\"$msg\"}"

            );
           
    }

    /**
     *
     * @Route("/report/{id}", name="_admin_concursocriterio_report", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function reportAction(Request $request, $id)
    {
         $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:ConcursoCriterio')->FindByConcursoOrderByParent($id);
        $concurso= $em->getRepository('AppWebBundle:Concurso')->find($id);

        $content = $this->renderView('AppWebBundle:ConcursoCriterio:report.html.twig',array(
            'title_list'=> "Listado de Criterios",
            'concurso'=>$concurso,
            'entities' => $entities,
        ));
        return new Response(
            ($content),
            200,
            array(
                'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
                'Content-Disposition' => 'attachment; filename="criterios.xls"',
                'Content-Length' => strlen($content)
            )
        );
     
    }

   
}
