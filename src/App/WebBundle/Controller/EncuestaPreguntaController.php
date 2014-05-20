<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\EncuestaPregunta;
use App\WebBundle\Form\EncuestaPreguntaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * EncuestaPregunta controller.
 *
 * @Route("/admin/encuestapregunta")
 */
class EncuestaPreguntaController extends Controller
{

    /**
     * Lists all EncuestaPregunta entities.
     *
     * @Route("/list/{id}", name="_admin_encuestapregunta", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $encuesta=$em->getRepository('AppWebBundle:Encuesta')->find($id);
        $entities = $encuesta->getPreguntas();

        return array(
            'entities' => $entities,
            'title_list'=>'Listado de Preguntas de Encuesta',
            'encuesta'=>$encuesta
        );
    }

    /**
     * Creates a new EncuestaPregunta entity.
     *
     * @Route("/", name="_admin_encuestapregunta_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $encuesta_id=$request->request->get('encuesta_id');
        $entity  = new EncuestaPregunta();
        $form = $this->createForm(new EncuestaPreguntaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $encuesta=$em->getRepository('AppWebBundle:Encuesta')->find($encuesta_id);
            $entity->setEncuesta($encuesta);
            $em->persist($entity);
            $em->flush();
            $success=true;
            $msg="Pregunta registrada satisfactoriamente";

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
     * Displays a form to create a new EncuestaPregunta entity.
     *
     * @Route("/new", name="_admin_encuestapregunta_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EncuestaPregunta();
        $form   = $this->createForm(new EncuestaPreguntaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a EncuestaPregunta entity.
     *
     * @Route("/{id}", name="encuestapregunta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:EncuestaPregunta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EncuestaPregunta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EncuestaPregunta entity.
     *
     * @Route("/{id}/edit", name="_admin_encuestapregunta_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:EncuestaPregunta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EncuestaPregunta entity.');
        }

        $editForm = $this->createForm(new EncuestaPreguntaType(), $entity);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing EncuestaPregunta entity.
     *
     * @Route("/{id}", name="_admin_encuestapregunta_update", options={"expose"=true})
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:EncuestaPregunta')->find($id);

        if (!$entity) {
            $msg="No se encontro el registro seleccionado";
            $success=false;
        }
        $editForm = $this->createForm(new EncuestaPreguntaType(), $entity);
        $editForm->bind($request);
        $errors = $this->get('validator')->validate($editForm);
        if ($entity && $editForm->isValid()&& count($errors)==0) {
            $em->persist($entity);
            $em->flush();
            $msg="Pregunta actualizada satisfactoriamente";
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
     * Deletes a EncuestaPregunta entity.
     *
     * @Route("/{id}", name="_admin_encuestapregunta_delete", options={"expose"=true})
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:EncuestaPregunta')->find($id);

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

    
}
