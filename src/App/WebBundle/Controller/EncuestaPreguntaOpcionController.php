<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\EncuestaPreguntaOpcion;
use App\WebBundle\Form\EncuestaPreguntaOpcionType;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * EncuestaPreguntaOpcion controller.
 *
 * @Route("/encuestapreguntaopcion")
 */
class EncuestaPreguntaOpcionController extends Controller
{

    /**
     * Lists all EncuestaPreguntaOpcion entities.
     *
     * @Route("/", name="encuestapreguntaopcion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:EncuestaPreguntaOpcion')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new EncuestaPreguntaOpcion entity.
     *
     * @Route("/", name="_admin_encuestapreguntaopcion_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
         
        $pregunta_id=$request->request->get('pregunta_id');
        $entity  = new EncuestaPreguntaOpcion();
        $form = $this->createForm(new EncuestaPreguntaOpcionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $pregunta=$em->getRepository('AppWebBundle:EncuestaPregunta')->find($pregunta_id);
            $entity->setPregunta($pregunta);
            $em->persist($entity);
            $em->flush();
            $success=true;
            $msg="Opción registrada satisfactoriamente";

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
     * Displays a form to create a new EncuestaPreguntaOpcion entity.
     *
     * @Route("/new", name="_admin_encuestapreguntaopcion_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EncuestaPreguntaOpcion();
        $form   = $this->createForm(new EncuestaPreguntaOpcionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a EncuestaPreguntaOpcion entity.
     *
     * @Route("/{id}", name="encuestapreguntaopcion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:EncuestaPreguntaOpcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EncuestaPreguntaOpcion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EncuestaPreguntaOpcion entity.
     *
     * @Route("/{id}/edit", name="_admin_encuestapreguntaopcion_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:EncuestaPreguntaOpcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EncuestaPreguntaOpcion entity.');
        }

        $editForm = $this->createForm(new EncuestaPreguntaOpcionType(), $entity);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing EncuestaPreguntaOpcion entity.
     *
     * @Route("/{id}", name="_admin_encuestapreguntaopcion_update", options={"expose"=true})
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:EncuestaPreguntaOpcion')->find($id);

        if (!$entity) {
            $msg="No se encontro el registro seleccionado";
            $success=false;
        }
        $editForm = $this->createForm(new EncuestaPreguntaOpcionType(), $entity);
        $editForm->bind($request);
        $errors = $this->get('validator')->validate($editForm);
        if ($entity && $editForm->isValid()&& count($errors)==0) {
            $em->persist($entity);
            $em->flush();
            $msg="Opción actualizada satisfactoriamente";
            $success=true;
        }else{
             $msgError=new \App\WebBundle\Util\MensajeError();
             $msgError->AddErrors($editForm);
             $msg=$msgError->getErrorsHTML();
             $success=false;
        }
        return new JsonResponse(array(
            'success' =>$success ,
            'message'=> $msg
        ));
    }
    /**
     * Deletes a EncuestaPreguntaOpcion entity.
     *
     * @Route("/{id}", name="_admin_encuestapreguntaopcion_delete", options={"expose"=true})
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:EncuestaPreguntaOpcion')->find($id);

        if ($entity) {
            $em->remove($entity);
            $em->flush();
            $msg="Registro eliminado satisfactoriamente";
            $success=true;
        }else{
            $msg="No se encontro el registro";
            $success=false;
        }

        return new JsonResponse(array(
            'success' =>$success ,
            'message'=> $msg
        ));  
    }

    /**
     * Creates a form to delete a EncuestaPreguntaOpcion entity by id.
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
