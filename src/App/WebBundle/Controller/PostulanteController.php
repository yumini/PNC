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
     * @Route("/{id}/perfil", name="_admin_postulante_perfil", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function perfilAction($id)
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
     * @Route("/{id}/edit", name="postulante_edit")
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
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Postulante entity.
     *
     * @Route("/{id}", name="postulante_update")
     * @Method("PUT")
     * @Template("AppWebBundle:Postulante:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Postulante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Postulante entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PostulanteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('postulante_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
     * Creates a form to delete a Postulante entity by id.
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
