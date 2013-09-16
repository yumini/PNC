<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\ConcursoCriterio;
use App\WebBundle\Form\ConcursoCriterioType;
use App\WebBundle\Services\ConcursoCriterioService;

/**
 * ConcursoCriterio controller.
 *
 * @Route("/admin/concursocriterio")
 */
class ConcursoCriterioController extends Controller
{

     /**
     * @Route("/json/{id}", name="_admin_concurso_criterio_json", options={"expose"=true})
     * @Method("GET")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function treeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $service=new ConcursoCriterioService($em);
        $json=$service->GetTreeJSON($id);

        return array(
            'result' => $json
            );
    }
    /**
     * Lists all ConcursoCriterio entities.
     *
     * @Route("/{id}", name="_admin_concurso_criterio", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:ConcursoCriterio')->FindByConcurso($id);
        $concurso= $em->getRepository('AppWebBundle:Concurso')->find($id);
        return array(
            'title_list'=> "Listado de Criterios",
            'concurso'=>$concurso,
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ConcursoCriterio entity.
     *
     * @Route("/save", name="_admin_concursocriterio_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction(Request $request)
    {
         $em = $this->getDoctrine()->getManager();
        $idConcurso=$request->request->get('idConcurso');
        $concurso = $em->getRepository('AppWebBundle:Concurso')->find($idConcurso);
        $tipoArbol= $em->getRepository('AppWebBundle:Catalogo')->getCatalogoByCodigo("TIPOARBOLCRITERIO","1");
        $entity  = new ConcursoCriterio();
        $form = $this->createForm(new ConcursoCriterioType(), $entity);
        $form->bind($request);
        
        $entity->setConcurso($concurso);
        $entity->setidpadre(0);
        $entity->setTipoArbolCriterio($tipoArbol);
        $em->persist($entity);
        $em->flush();

        return array(
            'result' => "{\"success\":\"true\"}"
        );

       
    }

    /**
     * Displays a form to create a new ConcursoCriterio entity.
     *
     * @Route("/{id}/new", name="_admin_concursocriterio_new", options={"expose"=true})
     * @Method("GET")
     * @Template("AppWebBundle:ConcursoCriterio:new.html.twig")
     */
    public function newAction($id)
    {
        $entity = new ConcursoCriterio();
        $form   = $this->createForm(new ConcursoCriterioType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ConcursoCriterio entity.
     *
     * @Route("/{id}", name="concursocriterio_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ConcursoCriterio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ConcursoCriterio entity.
     *
     * @Route("/{id}/edit", name="concursocriterio_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ConcursoCriterio entity.');
        }

        $editForm = $this->createForm(new ConcursoCriterioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ConcursoCriterio entity.
     *
     * @Route("/{id}/update", name="concursocriterio_update")
     * @Method("PUT")
     * @Template("AppWebBundle:ConcursoCriterio:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ConcursoCriterio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ConcursoCriterioType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('concursocriterio_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ConcursoCriterio entity.
     *
     * @Route("/{id}/delete", name="concursocriterio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ConcursoCriterio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('concursocriterio'));
    }

    /**
     * Creates a form to delete a ConcursoCriterio entity by id.
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
