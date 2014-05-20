<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\EtapaConcurso;
use App\WebBundle\Form\EtapaConcursoType;

/**
 * EtapaConcurso controller.
 *
 * @Route("/admin/etapaconcurso")
 */
class EtapaConcursoController extends Controller
{

    /**
     * Lists all EtapaConcurso entities.
     *
     * @Route("/{id}", name="_admin_etapaconcurso", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $concurso= $em->getRepository('AppWebBundle:Concurso')->find($id);
        $entities = $em->getRepository('AppWebBundle:EtapaConcurso')->findAllEtapas($id,$concurso->getTipoConcurso()->getId());
        
        return array(
            'entities' => $entities,
            'title_list'=> "Listado de Etapas",
            'concurso'=>$concurso
        );
    }
    /**
     * Creates a new EtapaConcurso entity.
     *
     * @Route("/{id}/save", name="admin_etapaconcurso_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction(Request $request,$id)
    {
        $active=($request->request->get('active')=='on')?true:false;
        $etapaid=$request->request->get('etapaId');
        $fechaInicio=$request->request->get('fechaInicio');
        $fechaFin=$request->request->get('fechaFin');
        $fechaExtension=$request->request->get('fechaExtension');
        $extendido=($request->request->get('extendido')=='true')?true:false;
        
        $em = $this->getDoctrine()->getManager();
       
         $entity = $em->getRepository('AppWebBundle:EtapaConcurso')->findByEtapa($id,$etapaid);
         $etapa = $em->getRepository('AppWebBundle:Etapa')->find($etapaid);
         $concurso = $em->getRepository('AppWebBundle:Concurso')->find($id);
        $success='false';
        if($active){
            if(!$entity){
                $entity  = new EtapaConcurso();
                $msg="Se habilito la etapa satisfactoriamente";
            }else{
                $msg="Se actualizó la etapa satisfactoriamente";
            }
             $entity->setConcurso($concurso);
             $entity->setEtapa($etapa);
             $entity->setFechaInicio(new \DateTime($fechaInicio));
             $entity->setFechaFin(new \DateTime($fechaFin));
             $entity->setExtendido($extendido);
             if($extendido)
                $entity->setFechaExtension(new \DateTime($fechaExtension));
             else
                $entity->setFechaExtension(null);
             $em->persist($entity);
             
             $success='true';
        }else{
            if($entity){
                $em->remove($entity);
                $msg="Se deshabilito la etapa satisfactoriamente";
                $success='true';
            }else{
                $msg="";
            }
        }
        $em->flush();
        return array(
            'result' => "{\"success\":\"$success\",\"message\":\"$msg\"}"
        );
    }

    /**
     * Displays a form to create a new EtapaConcurso entity.
     *
     * @Route("/new", name="admin_etapaconcurso_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EtapaConcurso();
        $form   = $this->createForm(new EtapaConcursoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a EtapaConcurso entity.
     *
     * @Route("/{id}", name="admin_etapaconcurso_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:EtapaConcurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EtapaConcurso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EtapaConcurso entity.
     *
     * @Route("/{id}/edit", name="admin_etapaconcurso_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:EtapaConcurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EtapaConcurso entity.');
        }

        $editForm = $this->createForm(new EtapaConcursoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing EtapaConcurso entity.
     *
     * @Route("/{id}", name="admin_etapaconcurso_update")
     * @Method("PUT")
     * @Template("AppWebBundle:EtapaConcurso:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:EtapaConcurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EtapaConcurso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EtapaConcursoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_etapaconcurso_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a EtapaConcurso entity.
     *
     * @Route("/{id}", name="admin_etapaconcurso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:EtapaConcurso')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EtapaConcurso entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_etapaconcurso'));
    }

    /**
     * Creates a form to delete a EtapaConcurso entity by id.
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
