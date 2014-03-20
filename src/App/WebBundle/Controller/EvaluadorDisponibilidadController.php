<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\EvaluadorDisponibilidad;
use App\WebBundle\Form\EvaluadorDisponibilidadType;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * EvaluadorDisponibilidad controller.
 *
 * @Route("/admin/evaluadordisponibilidad")
 */
class EvaluadorDisponibilidadController extends Controller
{

    /**
     * Lists all EvaluadorDisponibilidad entities.
     *
     * @Route("/json", name="_admin_evaluadordisponibilidad", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id=$request->query->get('id');
        $entities = $em->getRepository('AppWebBundle:EvaluadorDisponibilidad')->FindByEvaluador($id,true);
        return new JsonResponse($entities);
        //return array('entities' => $entities);
    }
    /**
     * Creates a new EvaluadorDisponibilidad entity.
     *
     * @Route("/json", name="_admin_evaluadordisponibilidad_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $evaluador_id=$data['evaluador_id'];
        $turno=$data['turno'];
        $value=$data['value'];
        $dia_id=$data['dia_id'];

        $em = $this->getDoctrine()->getManager();
        
        $evaluador = $em->getRepository('AppWebBundle:Evaluador')->find($evaluador_id);
        $dia = $em->getRepository('AppWebBundle:Catalogo')->find($dia_id);
        $entity = $em->getRepository('AppWebBundle:EvaluadorDisponibilidad')->FindByEvaluadorAndDia($evaluador_id,$dia_id);
        if(!$entity){
            $operacion='save';
            $entity  = new EvaluadorDisponibilidad();
        }else{
            $operacion='update';
        }
        $entity->setEvaluador($evaluador);
        $entity->setDia($dia);
        switch($turno){
            case 'manana':
                $entity->setManana($value);   
                break;
            case 'tarde':
                $entity->setTarde($value);
                break;
            case 'noche':
                $entity->setNoche($value);
                break;
        }
        
       
        $em->persist($entity);
        $em->flush();

        return new JsonResponse(array('success'=>true,'operacion'=>$operacion,'entity'=>$entity));
        
       
    }

    /**
     * Displays a form to create a new EvaluadorDisponibilidad entity.
     *
     * @Route("/new", name="_admin_evaluadordisponibilidad_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EvaluadorDisponibilidad();
        $form   = $this->createForm(new EvaluadorDisponibilidadType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a EvaluadorDisponibilidad entity.
     *
     * @Route("/{id}", name="evaluadordisponibilidad_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:EvaluadorDisponibilidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EvaluadorDisponibilidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EvaluadorDisponibilidad entity.
     *
     * @Route("/{id}/edit", name="_admin_evaluadordisponibilidad_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
       $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:EvaluadorDisponibilidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EvaluadorDisponibilidad entity.');
        }

        $editForm = $this->createForm(new EvaluadorDisponibilidadType(), $entity);
      

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
        
       
    }

    /**
     * Edits an existing EvaluadorDisponibilidad entity.
     *
     * @Route("/{id}/update", name="_admin_evaluadordisponibilidad_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:EvaluadorDisponibilidad')->find($id);
        $editForm = $this->createForm(new EvaluadorDisponibilidadType(), $entity);
        $editForm->bind($request);
        
        if ($entity) {
           
            $em->persist($entity);
            $em->flush();
        }else{
            $result=false;
            $msg="dia no encontrado para el evaluador";

        }
        return array(
            'result' => "{\"success\":\"$result\",message:\"$msg\"}"

        );
        
       
    }
    /**
     * Deletes a EvaluadorDisponibilidad entity.
     *
     * @Route("/{id}/delete", name="_admin_evaluadordisponibilidad_delete", options={"expose"=true})
     * @Template("AppWebBundle:Default:result.json.twig")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
         $msg="Se elimino el registro satisfactoriamente";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->getRepository('AppWebBundle:EvaluadorDisponibilidad')->find($id);
            if($entity)
            {
                $em->remove($entity);
                $em->flush();
            
            }else{
                $msg="No se encontro el registro"; 
                $result=false;
            }
            return array(
            'result' => "{\"success\":\"$result\",message:\"$msg\"}"

            );
            
       
    }

    /**
     * Deletes a EvaluadorDisponibilidad entity.
     *
     * @Route("/{id}/disponibilidadviaje", name="_admin_evaluadordisponibilidad_disponibilidadviaje", options={"expose"=true})
     * @Template("AppWebBundle:Default:result.json.twig")
     * @Method("POST")
     */
    public function disponibilidadViajeAction(Request $request,$id)
    {
            $value=$request->query->get('estado');
            $em = $this->getDoctrine()->getManager();           
            $entity = $em->getRepository('AppWebBundle:Evaluador')->find($id);
            if($entity)
            {
                $entity->setDisponibleviaje($value);
                $em->persist($entity);
                $em->flush();
                $result=true;
                $msg='';
            
            }else{
                $msg="No se encontro el registro"; 
                $result=false;
            }
            return array(
            'result' => "{\"success\":\"$result\",message:\"$msg\"}"

            );
            
       
    }

}
