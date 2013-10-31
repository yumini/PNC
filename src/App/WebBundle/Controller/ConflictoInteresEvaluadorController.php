<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\ConflictoInteresEvaluador;
use App\WebBundle\Form\ConflictoInteresEvaluadorType;

/**
 * ConflictoInteresEvaluador controller.
 *
 * @Route("/conflictointeresevaluador")
 */
class ConflictoInteresEvaluadorController extends Controller
{

     /**
     * Lists all PostulanteContacto entities.
     *
     * @Route("/{id}/conflictos", name="_admin_conflictodeinteres", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function ConflictodeInteresAction($id)
    {
       
         $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:ConflictoInteresEvaluador')->FindByEvaluadorPaginator($paginator,$page,3,$id);

        return array(
            'pagination' => $pagination,
            'idEvaluador'=>$id
        );
    }
    /**
     * Creates a new PostulanteContacto entity.
     *
     * @Route("/{id}/save", name="_admin_conflictodeinteres_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction(Request $request,$id)
    {
        $entity  = new ConflictoInteresEvaluador();
        $form = $this->createForm(new ConflictoInteresEvaluadorType(), $entity);
        $form->bind($request);
        $em = $this->getDoctrine()->getManager();
       
        $evaluador = $em->getRepository('AppWebBundle:Evaluador')->find($id);
       
        $entity->setEvaluador($evaluador);
        
        $em->persist($entity);
        $em->flush();

        return array(
            'result' => "{\"success\":\"true\"}"
        );
    }

    /**
     * Displays a form to create a new PostulanteContacto entity.
     *
     * @Route("/new", name="_admin_conflictodeinteres_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ConflictoInteresEvaluador();
        $form   = $this->createForm(new ConflictoInteresEvaluadorType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ConflictoInteresEvaluador entity.
     *
     * @Route("/{id}", name="conflictointeresevaluador_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:ConflictoInteresEvaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ConflictoInteresEvaluador entity.');
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
     * @Route("/{id}/edit", name="_admin_conflictodeinteres_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:ConflictoInteresEvaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ConflictoInteresEvaluador entity.');
        }

        $editForm = $this->createForm(new ConflictoInteresEvaluadorType(), $entity);
      

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

   /**
     * Edits an existing PostulanteContacto entity.
     *
     * @Route("/{id}/update", name="_admin_conflictodeinteres_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
       $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:ConflictoInteresEvaluador')->find($id);
        $editForm = $this->createForm(new ConflictoInteresEvaluadorType(), $entity);
        $editForm->bind($request);
        
        if ($entity) {
           
            $em->persist($entity);
            $em->flush();
        }else{
            $result=false;
            $msg="conflicto no encontrado para el evaluador";

        }
        return array(
            'result' => "{\"success\":\"$result\",message:\"$msg\"}"

        );
    }
    /**
     * Deletes a PostulanteContacto entity.
     *
     * @Route("/{id}", name="_admin_conflictodeinteres_delete", options={"expose"=true})
     * @Method("DELETE")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function deleteAction(Request $request, $id)
    {
         $msg="Se elimino el registro satisfactoriamente";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->getRepository('AppWebBundle:ConflictoInteresEvaluador')->find($id);
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

    /**
     * Creates a form to delete a ConflictoInteresEvaluador entity by id.
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
