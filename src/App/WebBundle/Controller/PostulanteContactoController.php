<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\PostulanteContacto;
use App\WebBundle\Form\PostulanteContactoType;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * PostulanteContacto controller.
 *
 * @Route("/admin/postulantecontacto")
 */
class PostulanteContactoController extends Controller
{

    /**
     * Lists all PostulanteContacto entities.
     *
     * @Route("/{id}/contactos", name="_admin_postulantecontacto", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function contactosPostulanteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
/*
        $entities = $em->getRepository('AppWebBundle:PostulanteContacto')->FindByPostulantePaginator($id);
        //$entities = $em->getRepository('AppWebBundle:PostulanteContacto')->findAll($id);

        return array(
            'entities' => $entities,
        );*/
        
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:PostulanteContacto')->FindByPostulantePaginator($paginator,$page,3,$id);

        return array(
            'pagination' => $pagination,
            'idPostulante'=>$id
        );
    }
    /**
     * Creates a new PostulanteContacto entity.
     *
     * @Route("/{id}/save", name="_admin_postulantecontacto_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request,$id)
    {
        $msg='';
        $entity  = new PostulanteContacto();
        $form = $this->createForm(new PostulanteContactoType(), $entity);
        $form->bind($request);
        $errors = $this->get('validator')->validate($form);
        if (count($errors)==0) {
            $em = $this->getDoctrine()->getManager();
            //$user = $this->container->get("security.context")->getToken()->getUser();
            $postulante = $em->getRepository('AppWebBundle:Postulante')->find($id);
            $entity->setPostulante($postulante);
            $em->persist($entity);
            $em->flush();
            $success=true;
            $msg="Registro agregado satisfactoriamente";
        }else{
            $msgError=new \App\WebBundle\Util\MensajeError();
            $msgError->AddErrors($form);
            $msg=$msgError->getErrorsHTML();       
            $success=false;
        }
        return new JsonResponse(array(
            'success' => $success, 
            'message' => $msg
        ));
       
    }

    /**
     * Displays a form to create a new PostulanteContacto entity.
     *
     * @Route("/new", name="_admin_postulantecontacto_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
         $entity = new PostulanteContacto();
        $form   = $this->createForm(new PostulanteContactoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PostulanteContacto entity.
     *
     * @Route("/{id}", name="postulantecontacto_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:PostulanteContacto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostulanteContacto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PostulanteContacto entity.
     *
     * @Route("/{id}/edit", name="_admin_postulantecontacto_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:PostulanteContacto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostulanteContacto entity.');
        }

        $editForm = $this->createForm(new PostulanteContactoType(), $entity);
      

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing PostulanteContacto entity.
     *
     * @Route("/{id}/update", name="_admin_postulantecontacto_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        
        $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:PostulanteContacto')->find($id);
        $editForm = $this->createForm(new PostulanteContactoType(), $entity);
        $editForm->bind($request);
        $errors = $this->get('validator')->validate($editForm);
        if (count($errors)==0) {
            if ($entity) {
               
                $em->persist($entity);
                $em->flush();
                $success=true;
                $msg="Registro actualizado satisfactoriamente";
            }else{
                $success=false;
                $msg="No se encopntro el conta contacto seleccionado";

            }
        }else{
            $msgError=new \App\WebBundle\Util\MensajeError();
            $msgError->AddErrors($editForm);
            $msg=$msgError->getErrorsHTML();       
            $success=false;
        }
        return new JsonResponse(array(
            'success' => $success, 
            'message' => $msg
        ));
        
       
    }
    /**
     * Deletes a PostulanteContacto entity.
     *
     * @Route("/{id}", name="_admin_postulantecontacto_delete", options={"expose"=true})
     * @Method("DELETE")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function deleteAction(Request $request, $id)
    {
        
            $msg="Se elimino el registro satisfactoriamente";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->getRepository('AppWebBundle:PostulanteContacto')->find($id);
            if($entity)
            {
                $em->remove($entity);
                $em->flush();
            
            }else{
                $msg="No se encontro el registro"; 
                $result=false;
            }
            return array(
            'result' => "{\"success\":\"$result\",message:\"$msg\"}"

            );
    }

   
}
