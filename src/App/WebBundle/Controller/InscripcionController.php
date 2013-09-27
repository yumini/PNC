<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Inscripcion;
use App\WebBundle\Form\InscripcionType;

/**
 * Inscripcion controller.
 *
 * @Route("/admin/inscripcion")
 */
class InscripcionController extends Controller
{

    /**
     * Lists all Inscripcion entities.
     *
     * @Route("/", name="inscripcion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:Inscripcion')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Inscripcion entity.
     *
     * @Route("/{id}/save", name="_admin_inscripcion_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction(Request $request,$id)
    {
        
        $entity  = new Inscripcion();
        $form = $this->createForm(new InscripcionType(), $entity);
        $form->bind($request);
        $em = $this->getDoctrine()->getManager();
        $concurso=$em->getRepository('AppWebBundle:Concurso')->find($id);
        $user = $this->container->get("security.context")->getToken()->getUser();
        $postulante = $em->getRepository('AppWebBundle:Postulante')->findByUser($user->getId());
        $entity->setConcurso($concurso);
        $entity->setPostulante($postulante);
        $em->persist($entity);
        $em->flush();

        return array(
            'result' => "{success:true}"
        );
    }

    /**
     * Creates a new Inscripcion entity.
     *
     * @Route("/upload/new", name="_admin_inscripcion_upload", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function uploadAction(Request $request)
    {
        
       $allowed = array('doc', 'docx', 'pdf','zip');
       if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($extension), $allowed)){
               $result="error";
            }

            if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name'])){
               $result="success";
            }
        }

        return array(
            'result' => "{status:$result}"
        );
    }


    /**
     * Displays a form to create a new Inscripcion entity.
     *
     * @Route("/{id}/new", name="_admin_inscripcion_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Inscripcion();
        $form   = $this->createForm(new InscripcionType(), $entity);
        $concurso=$em->getRepository('AppWebBundle:Concurso')->find($id);
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'concurso'=>$concurso
        );
    }

    /**
     * Finds and displays a Inscripcion entity.
     *
     * @Route("/{id}", name="inscripcion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Inscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscripcion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Inscripcion entity.
     *
     * @Route("/{id}/edit", name="inscripcion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Inscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscripcion entity.');
        }

        $editForm = $this->createForm(new InscripcionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Inscripcion entity.
     *
     * @Route("/{id}", name="inscripcion_update")
     * @Method("PUT")
     * @Template("AppWebBundle:Inscripcion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Inscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscripcion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new InscripcionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('inscripcion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Inscripcion entity.
     *
     * @Route("/{id}", name="inscripcion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:Inscripcion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Inscripcion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('inscripcion'));
    }

    /**
     * Creates a form to delete a Inscripcion entity by id.
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
