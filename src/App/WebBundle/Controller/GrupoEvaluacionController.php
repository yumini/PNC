<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\GrupoEvaluacion;
use App\WebBundle\Form\GrupoEvaluacionType;

/**
 * GrupoEvaluacion controller.
 *
 * @Route("/admin/grupoevaluacion")
 */
class GrupoEvaluacionController extends Controller
{

    /**
     * Lists all Evaluadore bt Group.
     *
     * @Route("/list/evaluadores/{_format}", defaults={"_format"="html"},name="_admin_grupoevaluacion_evaluadores_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listEvaluadoresAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idg=$request->query->get('grupo_id');
        $entities = $em->getRepository('AppWebBundle:Evaluador')->getEvaluadores($idg);
        //$entities=$entity->getEvaluadores();
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all Postulante bt Group.
     *
     * @Route("/list/postulantes/{_format}", defaults={"_format"="html"},name="_admin_grupoevaluacion_postulantes_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listPostulantesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idg=$request->query->get('grupo_id');
        $entities = $em->getRepository('AppWebBundle:Postulante')->getPostulantes($idg);
        //$entities=$entity->getPostulantes();
        return array(
            'entities' => $entities,
            
        );
    }
    /**
     * Lists all GrupoEvaluacion entities.
     *
     * @Route("/list/{_format}", defaults={"_format"="json"},name="_admin_grupoevaluacion_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:GrupoEvaluacion')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all GrupoEvaluacion entities.
     *
     * @Route("/",name="_admin_grupoevaluacion", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:GrupoEvaluacion')->FindAllPaginator($paginator,$page,5);

        return array(
            'pagination' => $pagination,
            'title_list'=> "Grupos de Evaluación",
            'action'=> "grupoevaluacion"
        );
    }
    /**
     * Creates a new GrupoEvaluacion entity.
     *
     * @Route("/save", name="_admin_grupoevaluacion_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction(Request $request)
    {

        $entity  = new GrupoEvaluacion();
        $form = $this->createForm(new GrupoEvaluacionType(), $entity);
        $form->bind($request);
        $em = $this->getDoctrine()->getManager();
        $entity->setEstado(1);
        $em->persist($entity);
        $em->flush();

        return array(
            'result' => "{success:true}"
        );
    }

    /**
     * Displays a form to create a new GrupoEvaluacion entity.
     *
     * @Route("/new", name="_admin_grupoevaluacion_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new GrupoEvaluacion();
        $form   = $this->createForm(new GrupoEvaluacionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a GrupoEvaluacion entity.
     *
     * @Route("/{id}", name="grupoevaluacion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GrupoEvaluacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing GrupoEvaluacion entity.
     *
     * @Route("/{id}/edit", name="_admin_grupoevaluacion_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GrupoEvaluacion entity.');
        }

        $editForm = $this->createForm(new GrupoEvaluacionType(), $entity);
        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing GrupoEvaluacion entity.
     *
     * @Route("/{id}/update", name="_admin_grupoevaluacion_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);
        $editForm = $this->createForm(new GrupoEvaluacionType(), $entity);
        $editForm->bind($request);
        
        if ($entity) {
           
            $em->persist($entity);
            $em->flush();
        }else{
            $result=false;
            $msg="grupo de Evaluación no encontrado";

        }
        return array(
            'result' => "{success:'$result',message:'$msg'}"

        );

      
    }
    /**
     * Deletes a GrupoEvaluacion entity.
     *
     * @Route("/{id}/delete", name="_admin_grupoevaluacion_delete", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function deleteAction(Request $request, $id)
    {
            $msg="Se elimino el registro satisfactoriamente";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);
            if($entity)
            {
                $em->remove($entity);
                $em->flush();
            
            }else{
                $msg="No se encontro el registro"; 
                $result=false;
            }
            return array(
            'result' => "{\"success\":\"$result\",\"message\":\"$msg\"}"

            );
    }

   
}
