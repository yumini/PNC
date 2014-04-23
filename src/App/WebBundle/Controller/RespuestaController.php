<?php

namespace App\WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\AspectoClave;
use App\WebBundle\Entity\CriterioAspectoClave;
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
        $idevaluador=$request->query->get('evaluador_id');
        $idinscripcion=$request->query->get('inscripcion_id');
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppWebBundle:Respuesta')->findAllById($idcriterio,$idevaluador,$idinscripcion,$isparent,true);
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
        $evaluador = $em->getRepository('AppWebBundle:Evaluador')->find($data['evaluador_id']);
        $aspectoclave = $em->getRepository('AppWebBundle:AspectoClave')->find($data['aspectoclave_id']);
        $inscripcion = $em->getRepository('AppWebBundle:Inscripcion')->find($data['inscripcion_id']);
        if($data['aspectoclave_id']!='0'){

            $criterioaspectoclave = $em->getRepository('AppWebBundle:CriterioAspectoClave')
                ->findByCriterioAndAspectoClave($data['criterio_padreid'],$data['aspectoclave_id'],true);
            if(!count($criterioaspectoclave)>0){
                $criterioaspecto = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($data['criterio_padreid']);
                $criterioaspectoclave=new CriterioAspectoClave();
                $criterioaspectoclave->setCriterio($criterioaspecto);
                $criterioaspectoclave->setAspectoclave($aspectoclave);
                $criterioaspectoclave->setEvaluador($evaluador);
                $criterioaspectoclave->setInscripcion($inscripcion);
                $em->persist($criterioaspectoclave);
            }
        }
        $entity  = new Respuesta();
        $entity->setInscripcion($inscripcion);
        $entity->setEvaluador($evaluador);
        $entity->setCriterio($criterio);
        if($data['aspectoclave_id']!='0')
            $entity->setAspectoclave($aspectoclave);
        $entity->setRespuesta($data['respuesta']);
        $entity->setPuntaje($data['puntaje']);
        $em->persist($entity);
        $em->flush();
        
        return new JsonResponse(array('success' => true));
    }

    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/json/rest/{id}", name="_admin_respuesta_delete", options={"expose"=true})
     * @Method("DELETE")
     * @Template()
     */
    public function deleteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Respuesta')->find($id);
        if($entity)
        {                
            $em->remove($entity);
            $em->flush();

        }
        return new JsonResponse(array('success' => true));
    }

    /**
     * Displays a form to create a edit Concurso entity.
     *
     * @Route("/edit", name="_admin_respuesta_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction()
    {
        return array(
            'title' => 'xx'
        );
    }

    /**
     * Displays a form to create a edit Concurso entity.
     *
     * @Route("/edit2", name="_admin_respuesta_edit2", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function edit2Action()
    {
        return array(
            'title' => 'xx'
        );
    }

    /**
     * @Route("/json/rest/{id}", name="_admin_respuesta_show", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function showAction(Request $request,$id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $entity=$em->getRepository("AppWebBundle:Respuesta")->findArray($id);
        
        return new JsonResponse($entity[0]);
    }

    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/json/rest/{id}", name="_admin_respuesta_update", options={"expose"=true})
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $entity = $em->getRepository('AppWebBundle:Respuesta')->find($id);
       
        if($entity)
        {                
            $entity->setRespuesta($data['respuesta']);
            $entity->setPuntaje($data['puntaje']);
            $em->persist($entity);
            $em->flush();

        }
        return new JsonResponse(array('success' => true));
    }

}
