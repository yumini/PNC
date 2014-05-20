<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Encuesta;
use App\WebBundle\Form\EncuestaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Encuesta controller.
 *
 * @Route("/admin/encuesta")
 */
class EncuestaController extends Controller
{

    /**
     * Lists all Encuesta entities.
     *
     * @Route("/", name="_admin_encuesta", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $field=$this->get('request')->query->get('filterField', 'e.titulo');
        $value=$this->get('request')->query->get('filterValue','');
        $sort=$this->get('request')->query->get('sort', 'e.titulo');

        $paginator=$this->get('knp_paginator');
        $dql   = "SELECT e FROM AppWebBundle:Encuesta e JOIN e.tipoEncuesta t
                where $field like '%$value%' order by $sort asc";
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query,$page,10);

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Encuestas",
            'action'=> "encuesta"
        );
    }
    /**
     * Creates a new Encuesta entity.
     *
     * @Route("/", name="_admin_encuesta_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $entity  = new Encuesta();
        $form = $this->createForm(new EncuestaType(), $entity);
        $form->bind($request);
        $errors = $this->get('validator')->validate($form);
        if (count($errors)==0 && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setEstado(1);
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
     * Displays a form to create a new Encuesta entity.
     *
     * @Route("/new", name="_admin_encuesta_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Encuesta();
        $form   = $this->createForm(new EncuestaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Encuesta entity.
     *
     * @Route("/{id}", name="encuesta_show", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Encuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encuesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Encuesta entity.
     *
     * @Route("/{id}/edit", name="_admin_encuesta_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Encuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encuesta entity.');
        }

        $editForm = $this->createForm(new EncuestaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing Encuesta entity.
     *
     * @Route("/{id}", name="_admin_encuesta_update", options={"expose"=true})
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Encuesta')->find($id);
        $editForm = $this->createForm(new EncuestaType(), $entity);
        $editForm->bind($request);
        $errors = $this->get('validator')->validate($editForm);
        
        if (count($errors)==0) {
            if ($entity) {

                $em->persist($entity);
                $em->flush();
                $msg='Registro actualizado satisfactoriamente';
                $success='true';
            }else{
                $result='false';
                $msg="encuesta no encontrada";
                
                $success=true;
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
     * Deletes a Encuesta entity.
     *
     * @Route("/{id}", name="_admin_encuesta_delete", options={"expose"=true})
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Encuesta')->find($id);
        if($entity){
            $em->remove($entity);
            $em->flush();
            $form = $this->createDeleteForm($id);
            $msg="Registro eliminado saisfactoriamente";
            $success=true;
        }else{
            $msg="No se encontro el registro";
            $success=false;
        }
        
        return new JsonResponse(array('success' =>$success,'message'=>$msg));
    }

    /**
     * Creates a form to delete a Encuesta entity by id.
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
