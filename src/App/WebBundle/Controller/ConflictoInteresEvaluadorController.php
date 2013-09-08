<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\ConflictoInteresEvaluador;
use App\WebBundle\Form\ConflictoInteresEvaluadorType;

/**
 * ConflictoInteresEvaluador controller.
 *
 * @Route("/conflictointeresevaluador")
 */
class ConflictoInteresEvaluadorController extends Controller
{

    /**
     * Lists all ConflictoInteresEvaluador entities.
     *
     * @Route("/", name="conflictointeresevaluador")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:ConflictoInteresEvaluador')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ConflictoInteresEvaluador entity.
     *
     * @Route("/", name="conflictointeresevaluador_create")
     * @Method("POST")
     * @Template("AppWebBundle:ConflictoInteresEvaluador:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new ConflictoInteresEvaluador();
        $form = $this->createForm(new ConflictoInteresEvaluadorType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('conflictointeresevaluador_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new ConflictoInteresEvaluador entity.
     *
     * @Route("/new", name="conflictointeresevaluador_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ConflictoInteresEvaluador();
        $form   = $this->createForm(new ConflictoInteresEvaluadorType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ConflictoInteresEvaluador entity.
     *
     * @Route("/{id}", name="conflictointeresevaluador_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:ConflictoInteresEvaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ConflictoInteresEvaluador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ConflictoInteresEvaluador entity.
     *
     * @Route("/{id}/edit", name="conflictointeresevaluador_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:ConflictoInteresEvaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ConflictoInteresEvaluador entity.');
        }

        $editForm = $this->createForm(new ConflictoInteresEvaluadorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ConflictoInteresEvaluador entity.
     *
     * @Route("/{id}", name="conflictointeresevaluador_update")
     * @Method("PUT")
     * @Template("AppWebBundle:ConflictoInteresEvaluador:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:ConflictoInteresEvaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ConflictoInteresEvaluador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ConflictoInteresEvaluadorType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('conflictointeresevaluador_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ConflictoInteresEvaluador entity.
     *
     * @Route("/{id}", name="conflictointeresevaluador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:ConflictoInteresEvaluador')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ConflictoInteresEvaluador entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('conflictointeresevaluador'));
    }

    /**
     * Creates a form to delete a ConflictoInteresEvaluador entity by id.
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
