<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Postulante;
use App\WebBundle\Form\PostulanteType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Postulante controller.
 *
 * @Route("/admin/postulante")
 */
class PostulanteController extends Controller
{

    /**
     * Lists all Postulante entities.
     *
     * @Route("/", name="_admin_postulante", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $field=$this->get('request')->query->get('filterField', 'u.username');
        $value=$this->get('request')->query->get('filterValue', '');
        $sort=$this->get('request')->query->get('sort', 'u.username');

        $paginator=$this->get('knp_paginator');
        //$pagination = $em->getRepository('AppWebBundle:Postulante')->FindAllPaginator($paginator,$page,2);

        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT p FROM AppWebBundle:Postulante p join p.usuario u
                where $field like '%$value%' order by $sort asc";
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query,$page,10);

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Postulantes",
            'action'=> "postulante"
        );
    }
    /**
     * Creates a new Postulante entity.
     *
     * @Route("/", name="postulante_create")
     * @Method("POST")
     * @Template("AppWebBundle:Postulante:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Postulante();
        $form = $this->createForm(new PostulanteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('postulante_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Postulante entity.
     *
     * @Route("/new", name="postulante_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Postulante();
        $form   = $this->createForm(new PostulanteType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Postulante entity.
     *
     * @Route("{id}/perfil", name="_admin_postulante_perfil", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function perfilAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //$user = $this->container->get("security.context")->getToken()->getUser();
        $entity = $em->getRepository('AppWebBundle:Postulante')->find($id);
        /*
        $entity=new Postulante();
        $entity->setRazonsocial("Coca Cola");
        $entity->setRuc("45784589125");
        $entity->setDireccion(" Av. Angamos 168....");
        $entity->setTelefono("073-4545455");
        */
        return array(
            'entity'      => $entity
        );
    }
    /**
     * Finds and displays a Postulante entity.
     *
     * @Route("/{id}", name="postulante_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Postulante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Postulante entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Postulante entity.
     *
     * @Route("/{id}/edit", name="_admin_postulante_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Postulante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Postulante entity.');
        }

        $editForm = $this->createForm(new PostulanteType(), $entity);
        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing Postulante entity.
     *
     * @Route("/{id}/update", name="_admin_postulante_update", options={"expose"=true})
     * @Method("PUT")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $msg="";
        $success=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Postulante')->find($id);
        $form = $this->createForm(new PostulanteType(), $entity);
        $form->bind($request);
        $errors = $this->get('validator')->validate($form);
        if (count($errors)==0 && $form->isValid()) {
                $em->persist($entity);
                $em->flush();
                $success=true;
                $msg="información actualizada satisfactoriamente";
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
     * Deletes a Postulante entity.
     *
     * @Route("/{id}", name="postulante_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:Postulante')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Postulante entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('postulante'));
    }

    


    /**
     * Displays a form to create a new Postulante entity.
     *
     * @Route("/categoria/new", name="_admin_postulantecategoria_new", options={"expose"=true})
     * @Method("GET")
     * @Template("AppWebBundle:Postulante:newCategoria.html.twig")
     */
    public function newCategoriaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:Catalogo')->getCategoriasPostulante();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Displays a form to create a new Postulante entity.
     *
     * @Route("{id}/categoria/save", name="_admin_postulantecategoria_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function saveCategoriaAction(Request $request,$id)
    {
        $msg="";
        $success="true";
        $categoriaId=$request->request->get('categoriaId');
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('AppWebBundle:Postulante')->find($id);
        
        $categoria=$em->getRepository('AppWebBundle:Catalogo')->find($categoriaId);
        
        $checkCategoria = function ($id) {
            return function($key, \App\WebBundle\Entity\Catalogo $c) use ($id) {
                return $c->getId() == $id;
            };
        };
        $categorias=$entity->getCategorias();
        $existe=$categorias->exists($checkCategoria($categoriaId));

        if(!$existe){
            $entity->addCategoria($categoria);
            $em->persist($entity);
            $em->flush();
            $msg="Categoria registrada satisfactoriamente.";
            $success="true";
        }else{
            $msg="categoria ya se encuentra registrada";
            $success="false";
        }
        return array(
            'result' => "{\"success\":\"$success\",\"msg\":\"$msg\"}"
        );
    }
    
    /**
     * Displays a form to create a new Postulante entity.
     *
     * @Route("/{id}/categoria/delete", name="_admin_postulantecategoria_delete", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function deleteCategoriaAction(Request $request,$id)
    {
        $msg="";
        $success="true";
        $idCategoria=$request->query->get('idCategoria');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Postulante')->find($id);
        $categoria=$em->getRepository('AppWebBundle:Catalogo')->find($idCategoria);
        $entity->removeCategoria($categoria);
        $em->persist($entity);
        $em->flush();
        return array(
            'result' => "{\"success\":\"$success\",\"msg\":\"$msg\"}"
        );
    }


    /**
     *
     * @Route("/report/postulante", name="_admin_postulante_report", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function reportAction(Request $request)
    {
        set_time_limit(300);
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:Postulante')->findAll();

        $content = $this->renderView('AppWebBundle:Postulante:report.html.twig',array(
            'title_list'=> "Listado de Postulantes",
            'entities'=>$entities
        ));
        return new Response(
            ($content),
            200,
            array(
                'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
                'Content-Disposition' => 'attachment; filename="postulantes.xls"',
                'Content-Length' => strlen($content)
            )
        );
     
    }
}
