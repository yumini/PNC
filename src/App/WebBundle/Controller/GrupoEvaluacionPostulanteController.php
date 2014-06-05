<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\GrupoEvaluacionPostulante;
use App\WebBundle\Form\GrupoEvaluacionPostulanteType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * GrupoEvaluacionPostulante controller.
 *
 * @Route("/admin/grupoevaluacionpostulante")
 */
class GrupoEvaluacionPostulanteController extends Controller
{

    /**
     * Lists all GrupoEvaluacionPostulante entities.
     *
     * @Route("/{id}", name="_admin_grupoevaluacionpostulante", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppWebBundle:GrupoEvaluacionPostulante')->FindByGrupo($id);

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all GrupoEvaluacionPostulante entities.
     *
     * @Route("/json/rest", name="_admin_json_grupoevaluacionpostulante", options={"expose"=true})
     * @Method("GET")
     */
    public function json_indexAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $grupo_id=$request->query->get('grupo_id');
        //$grupo_id=2;
        $entities = $em->getRepository('AppWebBundle:GrupoEvaluacionPostulante')->FindByGrupo($grupo_id,true);
        

        return new JsonResponse($entities);
    }

    /**
     * Creates a new GrupoEvaluacionPostulante entity.
     *
     * @Route("/{id}/save", name="_admin_grupoevaluacionpostulante_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request,$id)
    {
        $result='';
        $msg='';
        $inscripcionId=$request->request->get('inscripcionId');
        $em = $this->getDoctrine()->getManager();
        if($inscripcionId){
            $inscripcion=$em->getRepository('AppWebBundle:Inscripcion')->find($inscripcionId);
            $postulante=$inscripcion->getPostulante();
            $grupo=$em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);
            if($inscripcion){
                if($grupo){
                    $evaluadores=$em->getRepository('AppWebBundle:Postulante')->getEvaluadoresConflictosInteres($id,$postulante->getRuc());
                    if(count($evaluadores)==0){
                        $entity  = new GrupoEvaluacionPostulante();
                        $entity->setInscripcion($inscripcion);
                        $entity->setGrupo($grupo);
                        $em->persist($entity);
                        $em->flush();
                        $msg="Postulante agregado satisfactoriamente";
                        $result=true;
                    }else{
                        $result=false;
                        $msg="<h4 style='margin:2px;'><b>No se pudo agregar postulante</b></h4><br/>";
                        $msg.='Postulante presenta conflictos de interes con:<br/>';
                        foreach ($evaluadores as $p) {
                            $msg.='- '.$p['nombres'].' '.$p['apellidos'].'<br/>';
                        }
                    }
                }else{
                    $result=false;
                    $msg='No se encontro el grupo de evluación';
                }
            }else{
                $result=false;
                $msg='No se encontro el evaluador';
            }
        }else{
            $result=false;
            $msg='No se ha seleccionado un postulante';
        }
        return new JsonResponse(array('success' => $result,'message'=>$msg ));
         
    }

    /**
     * Displays a form to create a new GrupoEvaluacionPostulante entity.
     *
     * @Route("/{id}/new", name="_admin_grupoevaluacionpostulante_new",options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $grupo = $em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);
        $concursoId=$grupo->getConcurso()->getId();
        $postulantes = $em->getRepository('AppWebBundle:GrupoEvaluacionPostulante')->FindPostulantesDisponibles($concursoId);
        return array(
            'postulantes' => $postulantes
        );
    }

   

    
    /**
     * Deletes a GrupoEvaluacionEvaluador entity.
     *
     * @Route("/{id}/delete", name="_admin_grupoevaluacionpostulante_delete",options={"expose"=true})
     * @Method("DELETE")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function deleteAction( $id)
    {
       $msg='';
       $result='';
       $em = $this->getDoctrine()->getManager();
       $entity = $em->getRepository('AppWebBundle:GrupoEvaluacionPostulante')->find($id);

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
     * Creates a form to delete a GrupoEvaluacionPostulante entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
