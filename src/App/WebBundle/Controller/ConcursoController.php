<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Concurso;
use App\WebBundle\Form\ConcursoType;

/**
 * Concurso controller.
 *
 * @Route("/admin/concurso")
 */
class ConcursoController extends Controller
{

    /**
     * Lists all Concurso entities.
     *
     * @Route("/", name="_admin_concurso", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:Concurso')->FindAllPaginator($paginator,$page,10);

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Concursos",
            'action'=> "concurso"
        );
    }
    /**
     * Creates a new Concurso entity.
     *
     * @Route("/create", name="_admin_concurso_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Perfil:result.json.twig")
     */
    public function createAction(Request $request)
    {
        
        $entity  = new Concurso();
        $form = $this->createForm(new ConcursoType(), $entity);
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
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/new", name="_admin_concurso_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Concurso();
        $form   = $this->createForm(new ConcursoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Concurso entity.
     *
     * @Route("/{id}", name="concurso_show", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Concurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Concurso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Concurso entity.
     *
     * @Route("/{id}/edit", name="_admin_concurso_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Concurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Concurso entity.');
        }

        $editForm = $this->createForm(new ConcursoType(), $entity);
        
        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing Concurso entity.
     *
     * @Route("/{id}/update", name="_admin_concurso_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Perfil:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Concurso')->find($id);
        $editForm = $this->createForm(new ConcursoType(), $entity);
        $editForm->bind($request);
        
        if ($entity) {
           
            $em->persist($entity);
            $em->flush();
        }else{
            $result=false;
            $msg="perfil no encontrado";

        }
        return array(
            'result' => "{success:'$result',message:'$msg'}"

        );
    }
    /**
     * Deletes a Concurso entity.
     *
     * @Route("/{id}", name="_admin_concurso_delete", options={"expose"=true})
     * @Method("DELETE")
     * @Template("AppWebBundle:Perfil:result.json.twig")
     */
    public function deleteAction(Request $request, $id)
    {
            $msg="Se elimino el registro satisfactoriamente";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->getRepository('AppWebBundle:Concurso')->find($id);
            if($entity)
            {
                $em->remove($entity);
                $em->flush();
            
            }else{
                $msg="No se encontro el registro"; 
                $result=false;
            }
            return array(
            'result' => "{success:'$result',message:'$msg'}"

            );
    }

  
}