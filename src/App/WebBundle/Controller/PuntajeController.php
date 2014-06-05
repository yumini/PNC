<?php

namespace App\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\WebBundle\Entity\Puntaje;
/**
 * Concurso controller.
 *
 * @Route("/admin/puntaje")
 */
class PuntajeController extends Controller
{

	/**
     *
     * @Route("/json/rest", name="_admin_json_puntaje_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
	public function createAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);

        $criterio = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($data['concursocriterio_id']);
        $evaluacion = $em->getRepository('AppWebBundle:Evaluacion')->find($data['evaluacion_id']);

        $entity  = new Puntaje();
        $entity->setCriterio($criterio);
        $entity->setEvaluacion($evaluacion);
        $entity->setValor($data['valor']);
        $em->persist($entity);
        $em->flush();

         return new JsonResponse(array('success' => true));
	}

    /**
     *
     * @Route("/json/rest/{id}", name="_admin_json_puntaje_update", options={"expose"=true})
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);

        $entity = $em->getRepository('AppWebBundle:Puntaje')->find($id);

        $entity->setValor($data['valor']);
        $em->persist($entity);
        $em->flush();

         return new JsonResponse(array('success' => true));
    }

	 /**
     * Lists all AspectoClave entities.
     *
     * @Route("/json/rest", name="_admin_json_puntaje", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        
        $evaluacionId=$request->query->get('evaluacion_id');
        $criterioId=$request->query->get('concursocriterio_id');
        $em = $this->getDoctrine()->getManager();
        $entities=$em->getRepository('AppWebBundle:Puntaje')
            ->findByEvaluacionAndCriterio($evaluacionId,$criterioId,true);
        return new JsonResponse($entities);
    }
}
