<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Nota;
use App\WebBundle\Form\NotaType;

/**
 * Nota controller.
 *
 * @Route("/admin/nota")
 */
class NotaController extends Controller
{

    /**
     * @Route("/",name="_admin_nota_new", options={"expose"=true})
     * @Method("PUT")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function AddNotaAction(Request $request)
    {
        
        $user = $this->container->get("security.context")->getToken()->getUser();
        $descripcion=$request->request->get('descripcion');
        $em = $this->getDoctrine()->getManager();
       

        $entity=new Nota();
        $entity->setDescripcion($descripcion);
        $entity->setCompletada("0");
        $entity->setArchivada("0");
        $entity->setUsuario($user);
        $em->persist($entity);
        $em->flush();
        return array(
            'result' => "{success:true}"
        );       
    }
    /**
     * Lists all GrupoEvaluacion entities.
     *
     * @Route("/list/{_format}", defaults={"_format"="json"},name="_admin_nota_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
        $entities = $em->getRepository('AppWebBundle:Nota')->FindByUsuario($user->getId());

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Nota entities.
     *
     * @Route("/", name="nota")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:Nota')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Nota entity.
     *
     * @Route("/", name="nota_create")
     * @Method("POST")
     * @Template("AppWebBundle:Nota:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Nota();
        $form = $this->createForm(new NotaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nota_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Nota entity.
     *
     * @Route("/new", name="nota_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Nota();
        $form   = $this->createForm(new NotaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Nota entity.
     *
     * @Route("/{id}", name="nota_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Nota')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nota entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Nota entity.
     *
     * @Route("/{id}/edit", name="nota_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Nota')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nota entity.');
        }

        $editForm = $this->createForm(new NotaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Nota entity.
     *
     * @Route("/{id}", name="nota_update")
     * @Method("PUT")
     * @Template("AppWebBundle:Nota:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Nota')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nota entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new NotaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nota_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Nota entity.
     *
     * @Route("/{id}", name="_admin_nota_delete",options={"expose"=true})
     * @Method("DELETE")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function deleteAction(Request $request, $id)
    {
            $msg="";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:Nota')->find($id);

            if ($entity) {
                $em->remove($entity);
                $em->flush();
            }

           
        return array(
            'result' => "{success:'$result',msg:'$msg'}"
        );  
    }

    /**
     * Creates a form to delete a Nota entity by id.
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
