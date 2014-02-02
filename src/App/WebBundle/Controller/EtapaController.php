<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Etapa;
use App\WebBundle\Form\EtapaType;

/**
 * Etapa controller.
 *
 * @Route("/admin/etapa")
 */
class EtapaController extends Controller
{

    /**
     * Lists all Etapa entities.
     *
     * @Route("/", name="_admin_etapa", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:Etapa')->FindAllPaginator($paginator,$page,10);

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Etapas",
            'action'=> "etapa"
        );
    }
    /**
     * Creates a new Etapa entity.
     *
     * @Route("/save", name="_admin_etapa_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Etapa();
        $form = $this->createForm(new EtapaType(), $entity);
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
     * Displays a form to create a new Etapa entity.
     *
     * @Route("/new", name="_admin_etapa_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Etapa();
        $form   = $this->createForm(new EtapaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Etapa entity.
     *
     * @Route("/{id}", name="admin_etapa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Etapa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etapa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Etapa entity.
     *
     * @Route("/{id}/edit", name="_admin_etapa_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
         $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Etapa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find etapa entity.');
        }

        $editForm = $this->createForm(new EtapaType(), $entity);
        
        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );

       
    }

    /**
     * Edits an existing Etapa entity.
     *
     * @Route("/{id}/update", name="_admin_etapa_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
         $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Etapa')->find($id);
        $editForm = $this->createForm(new EtapaType(), $entity);
        $editForm->bind($request);
        
        if ($entity) {
           
            $em->persist($entity);
            $em->flush();
        }else{
            $result=false;
            $msg="etapa no encontrado";

        }
        return array(
            'result' => "{success:'$result',message:'$msg'}"

        );

    }
    /**
     * Deletes a Etapa entity.
     *
     * @Route("/{id}", name="_admin_etapa_delete", options={"expose"=true})
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
            $msg="Se elimino el registro satisfactoriamente";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->getRepository('AppWebBundle:Etapa')->find($id);
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
