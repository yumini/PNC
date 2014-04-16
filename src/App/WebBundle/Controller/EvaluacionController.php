<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Etapa Individual controller.
 *
 * @Route("/admin/evaluacion")
 */
class EvaluacionController extends Controller
{

    /**
     * Lists page index.
     *
     * @Route("/individual", name="_admin_evaluacionindividual", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function individualAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
        if($user->getPerfil()->getId()==2)
            $evaluador = $em->getRepository('AppWebBundle:Evaluador')->findByUser($user->getId());
        else
            $evaluador = $em->getRepository('AppWebBundle:Evaluador')->findAll();
        
        //$groups=null;
        return array(
            'title' => 'Evaluacion Individual',
            
            'user'=>$user,
            'evaluador'=>$evaluador
        );
    }
    /**
     * Lists page index.
     *
     * @Route("/concenso", name="_admin_evaluacionconcenso", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function concensoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
        if($user->getPerfil()->getId()==2)
            $evaluador = $em->getRepository('AppWebBundle:Evaluador')->findByUser($user->getId());
        else
            $evaluador = $em->getRepository('AppWebBundle:Evaluador')->findAll();
        
        //$groups=null;
        return array(
            'title' => 'Evaluacion de Concenso',
            'user'=>$user,
            'evaluador'=>$evaluador
        );
    }

    
}
