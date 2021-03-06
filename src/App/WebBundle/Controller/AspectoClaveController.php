<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\AspectoClave;
use App\WebBundle\Entity\Evaluacion;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * AspectoClave controller.
 *
 * @Route("/admin/aspectoclave")
 */
class AspectoClaveController extends Controller
{

    /**
     * Lists all AspectoClave entities.
     *
     * @Route("/json/rest", name="_admin_json_aspectoclave", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $isparent=($request->query->get('isparent')=='true')?true:false;
        $idcriterio=$request->query->get('idcriterio');
        $idconcurso=$request->query->get('idconcurso');
        $idevaluador=$request->query->get('evaluador_id');
        $idinscripcion=$request->query->get('inscripcion_id');
        $tipoetapa_id=$request->query->get('tipoetapa_id');
        if(isset($idcriterio)){
            
            $entities = $em->getRepository('AppWebBundle:AspectoClave')->findAllById($idcriterio,$idevaluador,$idinscripcion,$isparent,$tipoetapa_id,true);
        }
        if(isset($idconcurso)){
            
            $entities = $em->getRepository('AppWebBundle:AspectoClave')->findAllByConcursoId($idconcurso,$idevaluador,$idinscripcion,$tipoetapa_id,true);
        }
        
        return new JsonResponse($entities);
    }


    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/new", name="_admin_aspectoclave_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        return array(
            'title' => 'Nuevo Aspecto Clave'
        );
    }

     /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/new", name="_admin_aspectoclave_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction()
    {
        return array(
            'title' => 'Editar Aspecto Clave'
        );
    }

    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/json/rest", name="_admin_aspectoclave_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $criterio = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($data['criterio_id']);
        $evaluador = $em->getRepository('AppWebBundle:Evaluador')->find($data['evaluador_id']);
        $inscripcion = $em->getRepository('AppWebBundle:Inscripcion')->find($data['inscripcion_id']);
        $tipoEtapa=$em->getRepository('AppWebBundle:Catalogo')->find($data['tipoetapa_id']);
        $entity  = new AspectoClave();

        $entity->setCriterio($criterio);
        $entity->setEvaluador($evaluador);
        $entity->setInscripcion($inscripcion);
        $entity->setDescripcion($data['descripcion']);
        $entity->setTipoEtapa($tipoEtapa);
        $em->persist($entity);
        $em->flush();
        
        $this->CrearEvaluacion($evaluador,$inscripcion,$tipoEtapa);

        return new JsonResponse(array('success' => true));
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
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/json/rest/{id}", name="_admin_aspectoclave_update", options={"expose"=true})
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $entity = $em->getRepository('AppWebBundle:AspectoClave')->find($id);
        $criterio = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($data['criterio_id']);
        $evaluador = $em->getRepository('AppWebBundle:Evaluador')->find($data['evaluador_id']);
        $inscripcion = $em->getRepository('AppWebBundle:Inscripcion')->find($data['inscripcion_id']);
        if($entity)
        {                
            $entity->setCriterio($criterio);
            $entity->setEvaluador($evaluador);
            $entity->setInscripcion($inscripcion);
            $entity->setDescripcion($data['descripcion']);
            $em->persist($entity);
            $em->flush();

        }
        return new JsonResponse(array('success' => true));
    }

    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/changestate/{id}", name="_admin_aspectoclave_update_state", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function updatestateAction(Request $request,$id)
    {
        $estado=($request->query->get('estado')=='true')?true:false;
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:AspectoClave')->find($id);
        if($entity)
        {                
            $entity->setEstado($estado);
            $em->persist($entity);
            $em->flush();

        }
        return new JsonResponse(array('success' => true,'estado'=>$estado));
    }
    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/json/rest/{id}", name="_admin_aspectoclave_delete", options={"expose"=true})
     * @Method("DELETE")
     * @Template()
     */
    public function deleteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:AspectoClave')->find($id);
        if($entity)
        {                
            $em->remove($entity);
            $em->flush();

        }
        return new JsonResponse(array('success' => true));
    }
    
    /**
     * @Route("/json/rest/{id}", name="_admin_aspectoclave_show", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function showAction(Request $request,$id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $entity=$em->getRepository("AppWebBundle:AspectoClave")->findArray($id);
        
        return new JsonResponse($entity[0]);
    }
}
