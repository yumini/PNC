<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Perfil;
use App\WebBundle\Entity\Menu;
use App\WebBundle\Form\PerfilType;
use App\WebBundle\Menu\MenuTree;

/**
 * Perfil controller.
 *
 * @Route("/admin/perfil")
 */
class PerfilController extends Controller
{

     /**
     * @Route("/list/{_format}",defaults={"_format"="json"}, name="_admin_perfil_tree", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function listMenuTreeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
        $menuEntity=new MenuTree($em);
        $menuHTML=$menuEntity->GetTreeJSON();

        return array(
            'tree' => $menuHTML
            );
    }
     /**
     * Lists all Perfil entities.
     *
     * @Route("/", name="_admin_perfil", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:Perfil')->FindAllPaginator($paginator,$page,10);

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Perfiles",
            'action'=> "perfil"
        );
    }
    /**
     * Creates a new Perfil entity.
     *
     * @Route("/create", name="_admin_perfil_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Perfil:result.json.twig")
     */
    public function createAction(Request $request)
    {
        $msg='';
        $entity  = new Perfil();
        $form = $this->createForm(new PerfilType(), $entity);
        $form->bind($request);
        //$form->handleRequest($request);
        $strIds=$request->request->get('perfil');
        $ids=  explode(",", $strIds);
       

        $errors = $this->get('validator')->validate($form);
        if (count($errors)==0 && $form->isValid()) {
            $logger->info('perfil valido');
            $em = $this->getDoctrine()->getManager();
            
            for($i=0;$i<count($ids);$i++){
                $menu=new Menu();
                $menu=$em->getRepository('AppWebBundle:Menu')->find($ids[$i]);
                if($menu){
                    $entity->addMenu($menu);
                    $menu->addPerfile($entity);
                    $em->persist($menu);
                    
                }
            }
            $em->persist($entity);
            $em->flush();
            $msg='registro realizado satisfactoriamente';
            $success='true';
        }else{
           
            $msgError=new \App\WebBundle\Util\MensajeError();
            $msgError->AddErrors($form);
            $msg=$msgError->getErrorsHTML();       
            $success='false';
          
        }   
        return array(
            'result' => "{\"success\":\"$success\",\"message\":\"$msg\"}"
        );
    }

    /**
     * Displays a form to create a new Perfil entity.
     *
     * @Route("/new", name="_admin_perfil_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Perfil();
        $form   = $this->createForm(new PerfilType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Perfil entity.
     *
     * @Route("/{id}", name="perfil_show", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Perfil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Perfil entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * @Route("/list/{id}/accesos/{_format}",defaults={"_format"="json"}, name="_admin_perfil_accesos", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listIdAccesosPerfilAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $accesos = $em->getRepository('AppWebBundle:Perfil')->GetAccesos($id);
        
        return array(
            'accesos' => $accesos
        );
    }

    /**
     * Displays a form to edit an existing Perfil entity.
     *
     * @Route("/{id}/edit", name="_admin_perfil_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Perfil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Perfil entity.');
        }

        $editForm = $this->createForm(new PerfilType(), $entity);
        return array(
            'entity' => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing Perfil entity.
     *
     * @Route("/{id}/update", name="_admin_perfil_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Perfil:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        
        $msg="";
        $result=true;
        $strIds=$request->request->get('perfil');
        $ids=  explode(",", $strIds);
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AppWebBundle:Perfil')->RemoveAllAccesos($id);
       
        $entity = $em->getRepository('AppWebBundle:Perfil')->find($id);
        $editForm = $this->createForm(new PerfilType(), $entity);
        $editForm->bind($request);
        $errors = $this->get('validator')->validate($editForm);
        if (count($errors)==0) {
            if ($entity) {
            for($i=0;$i<count($ids);$i++){
                    $menu=new Menu();
                    $menu=$em->getRepository('AppWebBundle:Menu')->find($ids[$i]);
                    if($menu){
                        $entity->addMenu($menu);
                        $menu->addPerfile($entity);
                        $em->persist($menu);

                    }
                }
                $em->persist($entity);
                $em->flush();
                $success='true';
                $msg='Registro actualizado satisfactoriamente';
            }else{
               $msg='no se encontro el elemento';       
               $success='false'; 
            }
        }else{
            $msgError=new \App\WebBundle\Util\MensajeError();
            $msgError->AddErrors($editForm);
            $msg=$msgError->getErrorsHTML();       
            $success='false';

        }
        return array(
            'result' => "{\"success\":\"$success\",\"message\":\"$msg\"}"
        );
    }
    /**
     * Deletes a Perfil entity.
     *
     * @Route("/{id}/delete", name="_admin_perfil_delete", options={"expose"=true})
     * @Template("AppWebBundle:Perfil:result.json.twig")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
            $msg="Se elimino el registro satisfactoriamente";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->getRepository('AppWebBundle:Perfil')->find($id);
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
