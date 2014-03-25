<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Concurso;
use App\WebBundle\Form\ConcursoType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Concurso controller.
 *
 * @Route("/admin/concurso")
 */
class ConcursoController extends Controller
{

     /**
     * Lists all Concurso activos.
     *
     * @Route("/activos", name="_admin_concursos_activos", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function activosAction()
    {

        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:Concurso')->FindAllPaginator($paginator,$page,3);

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Concursos",
            'action'=> "concurso"
        );
    }
    /**
     * Lists all Concurso entities.
     *
     * @Route("/", name="_admin_concurso", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $field=$this->get('request')->query->get('filterField', 'c.nombre');
        $value=$this->get('request')->query->get('filterValue','');
        $sort=$this->get('request')->query->get('sort', 'c.nombre');

        $paginator=$this->get('knp_paginator');
        $dql   = "SELECT c FROM AppWebBundle:Concurso c JOIN c.tipoConcurso t
                where $field like '%$value%' order by $sort asc";
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query,$page,10);

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Concursos",
            'action'=> "concurso"
        );
    }

    
    /**
     * Lists all Concurso entities.
     *
     * @Route("/json/rest", name="_admin_json_concurso", options={"expose"=true})
     * @Method("GET")
     * @Template("AppWebBundle:Default:entity.json.twig")
     */
    public function json_indexAction(Request $request)
    {
        set_time_limit(300);
        ini_set("memory_limit","512M");
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppWebBundle:Concurso')->FindAllToArray();
        
        $result=json_encode($entities); 
        
        //$response = new Response(json_encode((array)$entities));
        //$response->headers->set('Content-Type', 'application/json');
        //return $response;
        //$serializedEntity = $this->container->get('serializer')->serialize($entities, 'json');
        //return new Response($serializedEntity);
        return array("entity"=>$entities);
        //$serializer = $this->get('serializer');
        //$json = $serializer->serialize($entities, 'json');
        
        //$response = new Response($json);
        //$response->headers->set('Content-Type', 'application/json');
        //return $response;
    }
    /**
     * Creates a new Concurso entity.
     *
     * @Route("/create", name="_admin_concurso_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction(Request $request)
    {
        
        $entity  = new Concurso();
        $form = $this->createForm(new ConcursoType(), $entity);
        $form->bind($request);
        $errors = $this->get('validator')->validate($form);
        $logger = $this->get('logger');
        $logger->info('grabando concurso');
        $logger->info(count($errors));
        if (count($errors)==0 && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setEstado(1);
            $em->persist($entity);
            $em->flush();
            $msg="registro realizado satisfactoriamente";
            $success='true';        
            
        }else{
             $msgError=new \App\WebBundle\Util\MensajeError();
             $msgError->AddErrors($form);
             $msg=$msgError->getErrorsHTML();
             $success='false';
        }
        return array(
            'result' => "{\"success\":\"$success\",\"message\":\"$msg\"}"
        );
      
    }

    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/new", name="_admin_concurso_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Concurso();
        $form   = $this->createForm(new ConcursoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Concurso entity.
     *
     * @Route("/{id}", name="_admin_concurso_show", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Concurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Concurso entity.');
        }

        return array(
            'entity'      => $entity
        );
    }
     /**
     * Finds and displays a Concurso entity.
     *
     * @Route("/{id}/inscripcion", name="_admin_concurso_showInscripcion", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function showInscripcionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Concurso')->find($id);
        $tipoConcurso=$entity->getTipoConcurso();
        
        $user = $this->container->get("security.context")->getToken()->getUser();
        $postulante = $em->getRepository('AppWebBundle:Postulante')->findByUser($user->getId());

        $register=$em->getRepository('AppWebBundle:Inscripcion')->IsRegister($postulante->getId(),$id);
        $inscripciones=$em->getRepository('AppWebBundle:Inscripcion')->GetConcursos($postulante->getId());
        $enabledInscripcion="";
        if($register)
            if($tipoConcurso->getCodigo()==1)
                $enabledInscripcion="disabled";
        
        return array(
            'entity'        =>$entity,
            'isRegister'    =>$register,
            'inscripciones'     =>$inscripciones,
            'EnabledInscripcion'=>$enabledInscripcion
        );
    }
/**
     * Finds and displays a Concurso entity.
     *
     * @Route("/{id}/inscripcionevaluador", name="_admin_concurso_showInscripcionEvaluador", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function showInscripcionEvaluadorAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Concurso')->find($id);
        
        $user = $this->container->get("security.context")->getToken()->getUser();
        $evaluador = $em->getRepository('AppWebBundle:Evaluador')->findByUser($user->getId());

        $register=$em->getRepository('AppWebBundle:InscripcionEvaluador')->IsRegister($evaluador->getId(),$id);
        
        $inscripciones=$em->getRepository('AppWebBundle:InscripcionEvaluador')->GetConcursos($evaluador->getId());
        $enabledInscripcion="";
        if($register)
                $enabledInscripcion="disabled";
        
        return array(
            'entity'        =>$entity,
            'isRegister'    =>$register,
            'inscripciones'     =>$inscripciones,
            'EnabledInscripcion'=>$enabledInscripcion
        );
    }
    /**
     * Displays a form to edit an existing Concurso entity.
     *
     * @Route("/{id}/edit", name="_admin_concurso_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Concurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Concurso entity.');
        }

        $editForm = $this->createForm(new ConcursoType(), $entity);
        
        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing Concurso entity.
     *
     * @Route("/{id}/update", name="_admin_concurso_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Perfil:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $msg="";
        $result=true;       
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:Concurso')->find($id);
        $editForm = $this->createForm(new ConcursoType(), $entity);
        $editForm->bind($request);
        $errors = $this->get('validator')->validate($editForm);
        
        if (count($errors)==0) {
            if ($entity) {

                $em->persist($entity);
                $em->flush();
                $msg='Registro actualizado satisfactoriamente';
                $success='true';
            }else{
                $result='false';
                $msg="perfil no encontrado";
                
                $success='false';
            }
        }else{
             $msgError=new \App\WebBundle\Util\MensajeError();
             $msgError->AddErrors($editForm);
             $msg=$msgError->getErrorsHTML();
             $success='false';
        }
         return array(
            'result' => "{\"success\":\"$success\",\"message\":\"$msg\"}"
        );
    }
    /**
     * Deletes a Concurso entity.
     *
     * @Route("/{id}", name="_admin_concurso_delete", options={"expose"=true})
     * @Method("DELETE")
     * @Template("AppWebBundle:Perfil:result.json.twig")
     */
    public function deleteAction($id)
    {
            $msg="Se elimino el registro satisfactoriamente";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->getRepository('AppWebBundle:Concurso')->find($id);
            if($entity)
            {
                $em->remove($entity);
                $em->flush();
            
            }else{
                $msg="No se encontro el registro"; 
                $result=false;
            }
            return array(
            'result' => "{success:'$result',message:'$msg'}"

            );
    }

  
}
