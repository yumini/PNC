<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Postulante;
use App\WebBundle\Form\PostulanteType;

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
     * @Route("/", name="postulante")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:Postulante')->findAll();

        return array(
            'entities' => $entities,
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
     * @Route("/perfil", name="_admin_postulante_perfil", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function perfilAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
        $entity = $em->getRepository('AppWebBundle:Postulante')->findByUser($user->getId());
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
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Postulante')->find($id);
        $editForm = $this->createForm(new PostulanteType(), $entity);
        $editForm->bind($request);
        
        if ($entity) {
           
            $em->persist($entity);
            $em->flush();
        }else{
            $result=false;
            $msg="postulante no encontrado";

        }
        return array(
            'result' => "{\"success\":\"$result\",\"message\":\"$msg\"}"

        );

      
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
     *
     * @Route("/upload/postulante/new", name="_admin_postulante_upload", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function uploadAction(Request $request)
    {
        
       $user = $this->container->get("security.context")->getToken()->getUser();
       $allowed = array('jpg', 'jpeg', 'png','bmp');
       if(isset($_FILES['filePerfil']) && $_FILES['filePerfil']['error'] == 0){

            $extension = pathinfo($_FILES['filePerfil']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($extension), $allowed)){
               $result="error";
            }
            $fileName=$user->getId().".".$extension;
            if(move_uploaded_file($_FILES['filePerfil']['tmp_name'], 'images/usuarios/'.$fileName)){
                $em = $this->getDoctrine()->getManager();
                $user->setImagen($fileName);
                $em->persist($user);
                $em->flush();
               $result="success";
            }
        }

        return array(
            'result' => "{\"status\":\"$result\",\"name\":\"$fileName\"}"
        );
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
     * @Route("/categoria/save", name="_admin_postulantecategoria_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function saveCategoriaAction(Request $request)
    {
        $msg="";
        $success="true";
        $categoriaId=$request->request->get('categoriaId');
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
        $entity = $em->getRepository('AppWebBundle:Postulante')->findByUser($user->getId());
        
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
     * @Route("/categoria/delete", name="_admin_postulantecategoria_delete", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function deleteCategoriaAction(Request $request)
    {
        $msg="";
        $success="true";
        $id=$request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
        $entity = $em->getRepository('AppWebBundle:Postulante')->findByUser($user->getId());
        $categoria=$em->getRepository('AppWebBundle:Catalogo')->find($id);
        $entity->removeCategoria($categoria);
        $em->persist($entity);
        $em->flush();
        return array(
            'result' => "{\"success\":\"$success\",\"msg\":\"$msg\"}"
        );
    }
}
