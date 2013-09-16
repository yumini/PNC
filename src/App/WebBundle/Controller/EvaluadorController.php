<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Evaluador;
use App\WebBundle\Form\EvaluadorType;

/**
 * Evaluador controller.
 *
 * @Route("/admin/evaluador")
 */
class EvaluadorController extends Controller
{

    /**
     * Lists all Evaluador entities.
     *
     * @Route("/", name="evaluador")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:Evaluador')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Evaluador entity.
     *
     * @Route("/", name="evaluador_create")
     * @Method("POST")
     * @Template("AppWebBundle:Evaluador:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Evaluador();
        $form = $this->createForm(new EvaluadorType(), $entity);
        $form->bind($request);
        $user = $this->container->get("security.context")->getToken()->getUser();
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUsuario($user);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evaluador_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Evaluador entity.
     *
     * @Route("/new", name="evaluador_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Evaluador();
        $form   = $this->createForm(new EvaluadorType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Postulante entity.
     *
     * @Route("/perfil", name="_admin_evaluador_perfil", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function perfilAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
        $entity = $em->getRepository('AppWebBundle:Evaluador')->findByUser($user->getId());
       
        return array(
            'entity'      => $entity
        );
    }
    /**
     * Finds and displays a Evaluador entity.
     *
     * @Route("/{id}", name="evaluador_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Evaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evaluador entity.');
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
     * @Route("/{id}/edit", name="_admin_evaluador_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Evaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evaluador entity.');
        }

        $editForm = $this->createForm(new EvaluadorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing Postulante entity.
     *
     * @Route("/{id}/update", name="_admin_evaluador_update", options={"expose"=true})
     * @Method("PUT")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Evaluador')->find($id);
        $editForm = $this->createForm(new EvaluadorType(), $entity);
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
     * Deletes a Evaluador entity.
     *
     * @Route("/{id}", name="evaluador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:Evaluador')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Evaluador entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('evaluador'));
    }

    /**
     * Creates a form to delete a Evaluador entity by id.
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
