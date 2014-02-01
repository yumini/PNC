<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Mensaje;
use App\WebBundle\Form\MensajeType;

/**
 * Mensaje controller.
 *
 * @Route("/mensaje")
 */
class MensajeController extends Controller
{

     /**
     * @Route("/conversacion",defaults={"_format"="json"},name="_admin_mensajes_conversacion", options={"expose"=true})
     * @Template()
     */
    public function MensajesConversacionAction(Request $request)
    {
        $idc=$request->query->get('conversacion_id');
        $em = $this->getDoctrine()->getManager();
        $entitie = $em->getRepository('AppWebBundle:Conversacion')->find($idc);
        $mensajes=$entitie->getMensajes();
        return array(
            'entities' => $mensajes
        );       
    }

    /**
     * @Route("/",name="_admin_mensaje_conversacion_new", options={"expose"=true})
     * @Method("PUT")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function AddMensajeAction(Request $request)
    {
        
        $idc=$request->request->get('conversacion_id');
        $mensaje=$request->request->get('mensaje');
        $em = $this->getDoctrine()->getManager();
        $conversacion=$em->getRepository('AppWebBundle:Conversacion')->find($idc);
        $entity=new Mensaje();
        $entity->setConversacion($conversacion);
        $entity->setMensaje($mensaje);     
        $em->persist($entity);
        $em->flush();
        return array(
            'result' => "{\"success\":\"true\"}"
        );       
    }


    /**
     * Lists all Mensaje entities.
     *
     * @Route("/", name="mensaje")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:Mensaje')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Mensaje entity.
     *
     * @Route("/", name="mensaje_create")
     * @Method("POST")
     * @Template("AppWebBundle:Mensaje:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Mensaje();
        $form = $this->createForm(new MensajeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mensaje_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Mensaje entity.
     *
     * @Route("/new", name="mensaje_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Mensaje();
        $form   = $this->createForm(new MensajeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Mensaje entity.
     *
     * @Route("/{id}", name="mensaje_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Mensaje')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mensaje entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Mensaje entity.
     *
     * @Route("/{id}/edit", name="mensaje_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Mensaje')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mensaje entity.');
        }

        $editForm = $this->createForm(new MensajeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Mensaje entity.
     *
     * @Route("/{id}", name="mensaje_update")
     * @Method("PUT")
     * @Template("AppWebBundle:Mensaje:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Mensaje')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mensaje entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MensajeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mensaje_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Mensaje entity.
     *
     * @Route("/{id}", name="mensaje_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:Mensaje')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mensaje entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('mensaje'));
    }

    /**
     * Creates a form to delete a Mensaje entity by id.
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
