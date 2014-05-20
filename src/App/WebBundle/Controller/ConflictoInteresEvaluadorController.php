<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\ConflictoInteresEvaluador;
use App\WebBundle\Form\ConflictoInteresEvaluadorType;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Template()
     */
    public function createAction(Request $request,$id)
    {
        $entity  = new ConflictoInteresEvaluador();
        $form = $this->createForm(new ConflictoInteresEvaluadorType(), $entity);
        $form->bind($request);
        $errors = $this->get('validator')->validate($form);
        if (count($errors)==0) {
             $em = $this->getDoctrine()->getManager();
             $evaluador = $em->getRepository('AppWebBundle:Evaluador')->find($id);
             $entity->setEvaluador($evaluador);
             
             if($entity->getHastalafecha()=='1'){
                $entity->setFecfin(null);
                
            }
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
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
       $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:ConflictoInteresEvaluador')->find($id);
        $editForm = $this->createForm(new ConflictoInteresEvaluadorType(), $entity);
        $editForm->bind($request);
        $errors = $this->get('validator')->validate($editForm);
        if (count($errors)==0) {
            if ($entity) {
               
                $em->persist($entity);
                $em->flush();
                $msg="Registro actualizado satisfactoriamente";
                $success=true;
            }else{
                $success=false;
                $msg="conflicto de Interes no encontrado para el evaluador";

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
