<?php

namespace App\WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\CriterioVisita;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * CriterioVisita controller.
 *
 * @Route("/admin/criteriovisita")
 */
class CriterioVisitaController extends Controller
{

    /**
     * Lists all CriterioVisita entities.
     *
     * @Route("/json/rest", name="_admin_json_criteriovisita", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $criterio=$request->query->get('concursocriterio_id');
        $entities = $em->getRepository('AppWebBundle:CriterioVisita')->findByCriterio($criterio,true);
        return new JsonResponse($entities);
    }


    /**
     * @Route("/json/rest/{id}", name="_admin_json_criteriovisita_show", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function json_showAction(Request $request,$id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $entity=$em->getRepository("AppWebBundle:CriterioVisita")->findArray($id);
        return new JsonResponse($entity[0]);
    }

    /**
     * Lists all CriterioVisita entities.
     *
     * @Route("/json/rest", name="_admin_json_criteriovisita_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $criterio = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($data['concursocriterio_id']);
        $entity  = new CriterioVisita();
        $entity->setCriterio($criterio);
        $entity->setDescripcion($data['descripcion']);
        $em->persist($entity);
        $em->flush();
        
        return new JsonResponse(array('success' => true));
    }

    /**
     * @Route("/json/rest/{id}", name="_admin_json_criteriovisita_update", options={"expose"=true})
     * @Method("PUT")
     * @Template()
     */
    public function json_updateAction(Request $request,$id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        //$criterio = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($data['concursocriterio_id']);
        $entity = $em->getRepository('AppWebBundle:CriterioVisita')->find($data['id']);

        if($entity){
            //$entity->setCriterio($criterio);
            $entity->setDescripcion($data['descripcion']);
            $em->persist($entity);
            $em->flush();
        }        

        
        
        return new JsonResponse(array('success' => true));
    }

    
}
