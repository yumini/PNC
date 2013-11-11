<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\GrupoEvaluacionPostulante;
use App\WebBundle\Form\GrupoEvaluacionPostulanteType;

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
     * Creates a new GrupoEvaluacionPostulante entity.
     *
     * @Route("/{id}/save", name="_admin_grupoevaluacionpostulante_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction(Request $request,$id)
    {
        $result='';
        $msg='';
        $evaluadorId=$request->request->get('evaluadorId');
        $em = $this->getDoctrine()->getManager();
        $postulante=$em->getRepository('AppWebBundle:Postulante')->find($evaluadorId);
        $grupo=$em->getRepository('AppWebBundle:GrupoEvaluacion')->find($id);
        if($postulante){
            if($grupo){
                $evaluadores=$em->getRepository('AppWebBundle:Postulante')->getEvaluadoresConflictosInteres($id,$postulante->getRuc());
                if(count($evaluadores)==0){
                    $entity  = new GrupoEvaluacionPostulante();
                    $entity->setPostulante($postulante);
                    $entity->setGrupo($grupo);
                    $em->persist($entity);
                    $em->flush();
                    $msg="Postulante agregado satisfactoriamente";
                    $result='true';
                }else{
                    $result="false";
                    $msg="<h4 style='margin:2px;'><b>No se pudo agregar postulante</b></h4><br/>";
                    $msg.='Postulante presenta conflictos de interes con:<br/>';
                    foreach ($evaluadores as $p) {
                        $msg.='- '.$p['nombres'].' '.$p['apellidos'].'<br/>';
                    }
                }
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
     * @Method("POST")
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
