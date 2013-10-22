<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Catalogo;
use App\WebBundle\Form\CatalogoType;

/**
 * Catalogo controller.
 *
 * @Route("/catalogo")
 */
class CatalogoController extends Controller
{

    /**
     * Lists all Catalogo entities.
     *
     * @Route("/", name="catalogo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:Catalogo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all Evaluadore bt Group.
     *
     * @Route("/list/catalogo/tdi/{_format}", defaults={"_format"="html"},name="_admin_tdi_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listCatalogoTdAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:Catalogo')->FindAllPaginator($paginator,$page,10,"TDI");

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Catalogo - Tipo Documento",
            'action'=> "catalogo"
        );
    }
    /**
     * Lists all Evaluadore bt Group.
     *
     * @Route("/list/catalogo/tcp/{_format}", defaults={"_format"="html"},name="_admin_tcp_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listCatalogoTcAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:Catalogo')->FindAllPaginator($paginator,$page,10,"TCP");

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Catalogo - Tipo Contacto Postulante",
            'action'=> "catalogo"
        );
    }
     /**
     * Lists all Evaluadore bt Group.
     *
     * @Route("/list/catalogo/tvi/{_format}", defaults={"_format"="html"},name="_admin_tvi_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listCatalogoViAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:Catalogo')->FindAllPaginator($paginator,$page,10,"TVI");

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Catalogo - Tipo Vinculo de Interes",
            'action'=> "catalogo"
        );
    }
    /**
     * Lists all Evaluadore bt Group.
     *
     * @Route("/list/catalogo/ble/{_format}", defaults={"_format"="html"},name="_admin_ble_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listCatalogoBlAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:Catalogo')->FindAllPaginator($paginator,$page,10,"BLE");

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Catalogo - Base Legales de Evaluador",
            'action'=> "catalogo"
        );
    }
    /**
     * Lists all Tipo Criterio.
     *
     * @Route("/list/catalogo/tcc/{_format}", defaults={"_format"="html"},name="_admin_tcc_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listCatalogoTccAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:Catalogo')->FindAllPaginator($paginator,$page,10,"TCC");

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Catalogo - Tipo Criterio Concurso",
            'action'=> "catalogo"
        );
    }
    /**
     * Lists all Tipo Criterio arbol.
     *
     * @Route("/list/catalogo/tac/{_format}", defaults={"_format"="html"},name="_admin_tac_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listCatalogoTacAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:Catalogo')->FindAllPaginator($paginator,$page,10,"TAC");

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Catalogo - Tipo Arbol Criterio",
            'action'=> "catalogo"
        );
    }
    /**
     * Creates a new Catalogo entity.
     *
     * @Route("/{codcat}/create/", name="_admin_td_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Catalogo:result.json.twig")
     */
    public function createAction(Request $request,$codcat)
    {
        
        $entity  = new Catalogo();
        $form = $this->createForm(new CatalogoType(), $entity);
        $form->bind($request);

      
            $em = $this->getDoctrine()->getManager();
            $entity->setCodcatalogo($codcat);
            $em->persist($entity);
            $em->flush();

       
        return array(
            'result' => "{success:true}"
        );
    }

    /**
     * Displays a form to create a new Catalogo entity.
     *
     * @Route("/{codcat}/new", name="_admin_td_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction($codcat)
    {
        $entity = new Catalogo();
        $form   = $this->createForm(new CatalogoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'codcat' => $codcat,
        );
    }

       
    /**
     * Finds and displays a Catalogo entity.
     *
     * @Route("/{id}", name="catalogo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Catalogo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Catalogo entity.
     *
     * @Route("/{id}/edit/", name="_admin_td_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Catalogo')->find($id);
        $codcat=$entity->getCodCatalogo();
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogo entity.');
        }

        $editForm = $this->createForm(new CatalogoType(), $entity);
       
        return array(
             'entity' => $entity,
             'form'   => $editForm->createView(),
             'codcat' => $codcat,
        );
    }

    /**
     * Edits an existing Catalogo entity.
     *
     * @Route("/{id}/update", name="_admin_td_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Catalogo:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $msg="";
        $result=true;
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Catalogo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catalogo entity.');
            $result=false;
            $msg="Fallo";
        }

        $editForm = $this->createForm(new CatalogoType(), $entity);
        $editForm->bind($request);

        //if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

        //}

        return array(
           'result' => "{success:'$result',message:'$msg'}"
        );
    }
    /**
     * Deletes a Catalogo entity.
     *
     * @Route("/{id}/delete", name="_admin_td_delete", options={"expose"=true})
     * @Template("AppWebBundle:Perfil:result.json.twig")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $msg="Se elimino el registro satisfactoriamente";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->getRepository('AppWebBundle:Catalogo')->find($id);
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

    /**
     * Creates a form to delete a Catalogo entity by id.
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
