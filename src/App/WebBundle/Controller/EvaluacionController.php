<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\WebBundle\Entity\Respuesta;
use App\WebBundle\Entity\AspectoClave;
use App\WebBundle\Entity\CriterioAspectoClave;
use App\WebBundle\Entity\Evaluacion;
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
     * @Route("/show", name="_admin_evaluacion_show", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $evaluadorId=$request->query->get('evaluador_id');
        $inscripcionId=$request->query->get('inscripcion_id');
        $tipoetapaId=$request->query->get('tipoetapa_id');

        $evaluador=$em->getRepository('AppWebBundle:Evaluador')->find($evaluadorId);
        $inscripcion=$em->getRepository('AppWebBundle:Inscripcion')->find($inscripcionId);
        $tipoEtapa=$em->getRepository('AppWebBundle:Catalogo')->find($tipoetapaId);
        $entity=$this->CrearEvaluacion($evaluador,$inscripcion,$tipoEtapa);

        
        $array['id']=$entity->getId();
        $array['fechaInicio']=$entity->getFechaInicio();
        $array['fechaCierre']=$entity->getFechaCierre();
        $array['abierta']=$entity->getAbierta();
        return new JsonResponse($array);
        
    }

    private function CrearEvaluacion($evaluador,$inscripcion,$tipoEtapa){
        $em = $this->getDoctrine()->getManager();

        $entity=$em->getRepository('AppWebBundle:Evaluacion')
            ->FindEvaluacion($evaluador->getId(),$inscripcion->getId(),$tipoEtapa->getId());
        if(!$entity){
            $entity=new Evaluacion();
            $entity->setEvaluador($evaluador);
            $entity->setInscripcion($inscripcion);
            $entity->setTipoEtapa($tipoEtapa);
            $em->persist($entity);
            $em->flush();
        }
        return $entity;
    }

    /**
     *
     * @Route("/cerrar/{id}", name="_admin_evaluacion_cerrar", options={"expose"=true})
     * @Method("PUT")
     * @Template()
     */
    public  function CerrarEvaluacionAction($id){
        $em = $this->getDoctrine()->getManager();

        $entity=$em->getRepository('AppWebBundle:Evaluacion')->find($id);
        if($entity){
            $entity->setFechaCierre(new \DateTime());
            $entity->setAbierta(false);
            $em->persist($entity);
            $em->flush();
        }
        return new JsonResponse(array('success' => true,'message'=>'Se terminó la evaluación satisfactoriamente'));
    }
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
            $evaluador = $em->getRepository('AppWebBundle:Evaluador')->findBy(array(), array('nombres' => 'ASC','apellidos' => 'ASC'));;
        
        //$groups=null;
        $tipoEtapa=$em->getRepository('AppWebBundle:Catalogo')->getCatalogoByCodigo('TIPOETAPA',1);
        return array(
            'title' => 'Evaluacion Individual',
            'tipoEtapa' =>$tipoEtapa,
            'etapa'=>null,
            'user'=>$user,
            'evaluador'=>$evaluador
        );
    }
    /**
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
        $tipoEtapa=$em->getRepository('AppWebBundle:Catalogo')->getCatalogoByCodigo('TIPOETAPA',2);
        return array(
            'title' => 'Evaluacion de Concenso',
            'tipoEtapa' =>$tipoEtapa,
            'user'=>$user,
            'evaluador'=>$evaluador
        );
    }

    /**
     *
     * @Route("/concenso/importar", name="_admin_evaluacionconcenso_importar", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function importarconcensoAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $idinscripcion=$request->query->get('inscripcion_id');
 
        $tipoEtapaIndividual=$em->getRepository('AppWebBundle:Catalogo')->getCatalogoByCodigo('TIPOETAPA',1);
        $tipoEtapaConcenso=$em->getRepository('AppWebBundle:Catalogo')->getCatalogoByCodigo('TIPOETAPA',2);

        $aspectosclaves = $em->getRepository('AppWebBundle:AspectoClave')
            ->findAllByEtapa($idinscripcion,$tipoEtapaIndividual->getId(),true,false);

        $respuestas = $em->getRepository('AppWebBundle:Respuesta')
            ->findAllByEtapa($idinscripcion,$tipoEtapaIndividual->getId(),true,false);

        $criteriosaspectosclaves = $em->getRepository('AppWebBundle:CriterioAspectoClave')
            ->findAllByEtapa($idinscripcion,$tipoEtapaIndividual->getId(),true,false);
        
        foreach ($aspectosclaves as $obj) {
            $entity=new AspectoClave();
            $entity->setInscripcion($obj->getInscripcion());
            $entity->setEvaluador($obj->getEvaluador());
            $entity->setCriterio($obj->getCriterio());
            $entity->setTipoEtapa($tipoEtapaConcenso);
            $entity->setDescripcion($obj->getDescripcion());

            $em->persist($entity);
           
        }

        foreach ($criteriosaspectosclaves as $obj) {
            $entity=new CriterioAspectoClave();
            $entity->setInscripcion($obj->getInscripcion());
            $entity->setEvaluador($obj->getEvaluador());
            $entity->setCriterio($obj->getCriterio());
            $entity->setAspectoclave($obj->getAspectoclave());
            $entity->setTipoEtapa($tipoEtapaConcenso);
           

            $em->persist($entity);
           
        }
        foreach ($respuestas as $obj) {
            $entity=new Respuesta();

            $entity->setInscripcion($obj->getInscripcion());
            $entity->setEvaluador($obj->getEvaluador());
            $entity->setCriterio($obj->getCriterio());
            $entity->setTipoEtapa($tipoEtapaConcenso);
            if($obj->getAspectoclave())
                $entity->setAspectoclave($obj->getAspectoclave());
            $entity->setRespuesta($obj->getRespuesta());
            $entity->setPuntaje($obj->getPuntaje());
            
            $em->persist($entity);
            
        }
        
        $em->flush();
        $em->clear();
        return new JsonResponse(array(
            'success' => true
        ));
    }


    
}
