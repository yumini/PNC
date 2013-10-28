<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\InscripcionEvaluador;
use App\WebBundle\Form\InscripcionEvaluadorType;

/**
 * InscripcionEvaluador controller.
 *
 * @Route("/inscripcionevaluador")
 */
class InscripcionEvaluadorController extends Controller
{

    /**
     * Lists all InscripcionEvaluador entities.
     *
     * @Route("/", name="inscripcionevaluador", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:InscripcionEvaluador')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new InscripcionEvaluador entity.
     *
     * @Route("/{id}/save", name="_admin_inscripcionevaluador_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction($id)
    {
        $msg="";
        $result="false";
        $entity  = new InscripcionEvaluador();
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
        $evaluador = $em->getRepository('AppWebBundle:Evaluador')->findByUser($user->getId());
        $register=$em->getRepository('AppWebBundle:InscripcionEvaluador')->IsRegister($evaluador->getId(),$id);
        
        if(!$register){
            $concurso=$em->getRepository('AppWebBundle:Concurso')->find($id);
            $entity->setConcurso($concurso);
            $entity->setEvaluador($evaluador);
            $em->persist($entity);
            $em->flush();
            $result="true";
            $msg="Inscripción realizada satisfactoriamente";
        }else{
            $msg="Evaluador ya se encuentra inscrito en el concurso";
        }
        
         return array(
            'result' => "{success:'$result',message:'$msg'}"

        );
    }

    /**
     * Displays a form to create a new InscripcionEvaluador entity.
     *
     * @Route("/{id}/new", name="_admin_inscripcionevaluador_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //obteniendo los terminos de aceptación
        $concurso=$em->getRepository('AppWebBundle:Concurso')->find($id);
        $terminos = $em->getRepository('AppWebBundle:Catalogo')->getCatalogoByCodigo("BLE",1);
        return array(
            'terminos' => $terminos,
            'concurso'=>$concurso
        );
    }

    /**
     * Finds and displays a InscripcionEvaluador entity.
     *
     * @Route("/{id}", name="inscripcionevaluador_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:InscripcionEvaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InscripcionEvaluador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing InscripcionEvaluador entity.
     *
     * @Route("/{id}/edit", name="inscripcionevaluador_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:InscripcionEvaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InscripcionEvaluador entity.');
        }

        $editForm = $this->createForm(new InscripcionEvaluadorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing InscripcionEvaluador entity.
     *
     * @Route("/{id}", name="inscripcionevaluador_update")
     * @Method("PUT")
     * @Template("AppWebBundle:InscripcionEvaluador:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:InscripcionEvaluador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InscripcionEvaluador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new InscripcionEvaluadorType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('inscripcionevaluador_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a InscripcionEvaluador entity.
     *
     * @Route("/{id}", name="inscripcionevaluador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:InscripcionEvaluador')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InscripcionEvaluador entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('inscripcionevaluador'));
    }

    /**
     * Creates a form to delete a InscripcionEvaluador entity by id.
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
