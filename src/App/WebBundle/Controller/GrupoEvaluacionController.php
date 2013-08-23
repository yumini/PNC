<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\GrupoEvaluacion;
use App\WebBundle\Form\GrupoEvaluacionType;

/**
 * GrupoEvaluacion controller.
 *
 * @Route("/admin/grupoevaluacion")
 */
class GrupoEvaluacionController extends Controller
{

    /**
     * Lists all Evaluadore bt Group.
     *
     * @Route("/list/evaluadores/{_format}", defaults={"_format"="html"},name="_admin_grupoevaluacion_evaluadores_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listEvaluadoresAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idg=$request->query->get('grupo_id');
        $entities = $em->getRepository('AppWebBundle:Evaluador')->getEvaluadores($idg);
        //$entities=$entity->getEvaluadores();
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all Postulante bt Group.
     *
     * @Route("/list/postulantes/{_format}", defaults={"_format"="html"},name="_admin_grupoevaluacion_postulantes_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listPostulantesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idg=$request->query->get('grupo_id');
        $entities = $em->getRepository('AppWebBundle:Postulante')->getPostulantes($idg);
        //$entities=$entity->getPostulantes();
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all GrupoEvaluacion entities.
     *
     * @Route("/list/{_format}", defaults={"_format"="json"},name="_admin_grupoevaluacion_list", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:GrupoEvaluacion')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all GrupoEvaluacion entities.
     *
     * @Route("/",name="_admin_grupoevaluacion", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:GrupoEvaluacion')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new GrupoEvaluacion entity.
     *
     * @Route("/", name="grupoevaluacion_create")
     * @Method("POST")
     * @Template("AppWebBundle:GrupoEvaluacion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new GrupoEvaluacion();
        $form = $this->createForm(new GrupoEvaluacionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('grupoevaluacion_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new GrupoEvaluacion entity.
     *
     * @Route("/new", name="grupoevaluacion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new GrupoEvaluacion();
        $form   = $this->createForm(new GrupoEvaluacionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a GrupoEvaluacion entity.
     *
     * @Route("/{id}", name="grupoevaluacion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GrupoEvaluacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing GrupoEvaluacion entity.
     *
     * @Route("/{id}/edit", name="grupoevaluacion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GrupoEvaluacion entity.');
        }

        $editForm = $this->createForm(new GrupoEvaluacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing GrupoEvaluacion entity.
     *
     * @Route("/{id}", name="grupoevaluacion_update")
     * @Method("PUT")
     * @Template("AppWebBundle:GrupoEvaluacion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GrupoEvaluacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new GrupoEvaluacionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('grupoevaluacion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a GrupoEvaluacion entity.
     *
     * @Route("/{id}", name="grupoevaluacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GrupoEvaluacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('grupoevaluacion'));
    }

    /**
     * Creates a form to delete a GrupoEvaluacion entity by id.
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
