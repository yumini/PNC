<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\GrupoEvaluacionEvaluador;
use App\WebBundle\Form\GrupoEvaluacionEvaluadorType;

/**
 * GrupoEvaluacionEvaluador controller.
 *
 * @Route("/admin/grupoevaluacionevaluador")
 */
class GrupoEvaluacionEvaluadorController extends Controller
{

    /**
     * Lists all GrupoEvaluacionEvaluador entities.
     *
     * @Route("/{id}", name="_admin_grupoevaluacionevaluador", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:GrupoEvaluacionEvaluador')->FindByGrupo($id);

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new GrupoEvaluacionEvaluador entity.
     *
     * @Route("/{id}/save", name="_admin_grupoevaluacionevaluador_save",options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction(Request $request,$id)
    {
        $result='';
        $msg='';
        $evaluadorId=$request->request->get('evaluadorId');
        $em = $this->getDoctrine()->getManager();
        $evaluador=$em->getRepository('AppWebBundle:Evaluador')->find($evaluadorId);
        $grupo=$em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);
        if($evaluador){
            if($grupo){
                $entity  = new GrupoEvaluacionEvaluador();
                $entity->setEvaluador($evaluador);
                $entity->setGrupo($grupo);
                $em->persist($entity);
                $em->flush();
                $result='true';
            }else{
                $result="false";
                $msg='No se encontro el grupo de evluación';
            }
        }else{
            $result="false";
            $msg='No se encontro el evaluador';
        }
         return array(
            'result' => "{\"success\":\"$result\",\"message\":\"$msg\"}"

        );
    }

    /**
     * Displays a form to create a new GrupoEvaluacionEvaluador entity.
     *
     * @Route("/{id}/new", name="_admin_grupoevaluacionevaluador_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $grupo = $em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);
        $concursoId=$grupo->getConcurso()->getId();
        $evaluadores = $em->getRepository('AppWebBundle:GrupoEvaluacionEvaluador')->FindEvaluadoresDisponibles($concursoId);
        return array(
            'evaluadores' => $evaluadores
        );
    }

    
    /**
     * Deletes a GrupoEvaluacionEvaluador entity.
     *
     * @Route("/{id}/delete", name="_admin_grupoevaluacionevaluador_delete",options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function deleteAction(Request $request, $id)
    {
       $msg='';
       $result='';
       $em = $this->getDoctrine()->getManager();
       $entity = $em->getRepository('AppWebBundle:GrupoEvaluacionEvaluador')->find($id);

        if ($entity) {
            $em->remove($entity);
            $em->flush();
            $result='true';
        }else{
            $msg="No se encontro el registro";
            $result='false';
        }
        return array(
            'result' => "{\"success\":\"$result\",\"message\":\"$msg\"}"

        );
    }
    /**
     * Deletes a GrupoEvaluacionEvaluador entity.
     *
     * @Route("/{id}/activelider", name="_admin_grupoevaluacionevaluador_activelider",options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function activeLiderAction(Request $request, $id)
    {
       $msg='';
       $result='';
       $em = $this->getDoctrine()->getManager();
       $entity = $em->getRepository('AppWebBundle:GrupoEvaluacionEvaluador')->find($id);
       
        if ($entity) {
            $em->getRepository('AppWebBundle:GrupoEvaluacionEvaluador')->ActiveLider($entity);
            $result='true';
        }else{
            $msg="No se encontro el registro";
            $result='false';
        }
        return array(
            'result' => "{\"success\":\"$result\",\"message\":\"$msg\"}"

        );
    }

    
}