<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Conversacion;
use App\WebBundle\Form\ConversacionType;
use App\WebBundle\Entity\Mensaje;
/**
 * Conversacion controller.
 *
 * @Route("/conversacion")
 */
class ConversacionController extends Controller
{

    /**
     * @Route("/listUserForChat.json",name="_admin_conversacion_users_chat",  defaults={"_format"="json"}, options={"expose"=true})
     * @Template()
     */
    public function listUsersForChatAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppWebBundle:Conversacion')->findAll();
        return array(
            'entities' => $entities,
        );       
    }

    /**
     * @Route("/list.json",name="_admin_conversacion_format",  defaults={"_format"="json"}, options={"expose"=true})
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppWebBundle:Conversacion')->findAll();
        return array(
            'entities' => $entities,
        );       
    }
    
   
    /**
     * Lists all Conversacion entities.
     *
     * @Route("/", name="conversacion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:Conversacion')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Conversacion entity.
     *
     * @Route("/", name="conversacion_create")
     * @Method("POST")
     * @Template("AppWebBundle:Conversacion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Conversacion();
        $form = $this->createForm(new ConversacionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('conversacion_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Conversacion entity.
     *
     * @Route("/new", name="conversacion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Conversacion();
        $form   = $this->createForm(new ConversacionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Conversacion entity.
     *
     * @Route("/{id}", name="conversacion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Conversacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conversacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Conversacion entity.
     *
     * @Route("/{id}/edit", name="conversacion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Conversacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conversacion entity.');
        }

        $editForm = $this->createForm(new ConversacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Conversacion entity.
     *
     * @Route("/{id}", name="conversacion_update")
     * @Method("PUT")
     * @Template("AppWebBundle:Conversacion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Conversacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conversacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ConversacionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('conversacion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Conversacion entity.
     *
     * @Route("/{id}", name="conversacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:Conversacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Conversacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('conversacion'));
    }

    /**
     * Creates a form to delete a Conversacion entity by id.
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
