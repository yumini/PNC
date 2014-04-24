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
