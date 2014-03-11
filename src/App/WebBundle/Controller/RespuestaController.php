<?php

namespace App\WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Respuesta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Respuesta controller.
 *
 * @Route("/admin/respuesta")
 */
class RespuestaController extends Controller
{

    /**
     * Lists all Respuesta entities.
     *
     * @Route("/json/rest", name="_admin_json_respuesta", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //si es parent devuelve las respuesta asociadas a sus preguntas, sino devuelve las respuestas directas al criterio
        $isparent=($request->query->get('isparent')=='true')?true:false;
        $idcriterio=$request->query->get('idcriterio');
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppWebBundle:Respuesta')->findAllById($idcriterio,$isparent,true);
        return new JsonResponse($entities);
    }

    

    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/new", name="_admin_respuesta_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        return array(
            'title' => 'xx'
        );
    }

    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/new2", name="_admin_respuesta_new2", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function new2Action()
    {
        return array(
            'title' => 'xx'
        );
    }

    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/json/rest", name="_admin_respuesta_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $criterio = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($data['criterio_id']);
        $entity  = new Respuesta();

        $entity->setCriterio($criterio);
        $entity->setRespuesta($data['respuesta']);
        $entity->setPuntaje($data['puntaje']);
        $em->persist($entity);
        $em->flush();
        
        return new JsonResponse(array('success' => true));
    }
}
