<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Etapa Individual controller.
 *
 * @Route("/evaluacion/individual")
 */
class EvaluacionIndividualController extends Controller
{

    /**
     * Lists page index.
     *
     * @Route("/", name="_admin_evaluacionindividual_page", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function pageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
       
        $evaluador = $em->getRepository('AppWebBundle:Evaluador')->findByUser($user->getId());
        $groups = $em->getRepository('AppWebBundle:GrupoEvaluacionEvaluador')->AllGroupByEvaluador($evaluador->getId());
        //$groups=null;
        return array(
            'title_list' => 'Etapa de Evaluacion Individual',
            'groups'=>$groups,
            'evaluador'=>$evaluador
        );
    }
    /**
     * Lists all Etapa Individual entities.
     *
     * @Route("/", name="_admin_evaluacionindividual", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        
    }
    /**
     * Creates a new Etapa Individual entity.
     *
     * @Route("/save", name="_admin_evaluacionindividual_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction(Request $request)
    {
        
    }

    /**
     * Displays a form to create a new Etapa Individual entity.
     *
     * @Route("/new", name="_admin_evaluacionindividual_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        
    }

    /**
     * Finds and displays a Etapa Individual entity.
     *
     * @Route("/{id}", name="_admin_evaluacionindividual_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        
    }

    /**
     * Displays a form to edit an existing Etapa Individual entity.
     *
     * @Route("/{id}/edit", name="_admin_evaluacionindividual_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
       

       
    }

    /**
     * Edits an existing Etapa Individual entity.
     *
     * @Route("/{id}/update", name="_admin_evaluacionindividual_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        

    }
    /**
     * Deletes a Etapa Individual entity.
     *
     * @Route("/{id}", name="_admin_evaluacionindividual_delete", options={"expose"=true})
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
           

    }

    
}
