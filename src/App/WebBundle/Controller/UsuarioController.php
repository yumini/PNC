<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\Usuario;
use App\WebBundle\Entity\Postulante;
use App\WebBundle\Entity\Evaluador;
use App\WebBundle\Form\UsuarioType;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Model\UserInterface;
/**
 * Usuario controller.
 *
 * @Route("/admin/usuario")
 */
class UsuarioController extends Controller
{

    /**
     * Lists all Usuario entities.
     *
     * @Route("/", name="_admin_usuario", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $page=$this->get('request')->query->get('page', 1);
        $paginator=$this->get('knp_paginator');
        $pagination = $em->getRepository('AppWebBundle:Usuario')->FindAllPaginator($paginator,$page,10);

        return array(
            'pagination' => $pagination,
            'title_list'=> "Listado de Usuarios",
            'action'=> "usuario"
        );
    }
    /**
     * Creates a new Usuario entity.
     *
     * @Route("/save", name="_admin_usuario_save", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function createAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
        
        $user = $userManager->createUser();
        $user->setEnabled(true);
        
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, new UserEvent($user, $request));

        $form = $formFactory->createForm();
        $form->setData($user);
        $msg = '';
        $form->bind($request);
        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
            $userManager->updateUser($user);

            $response = $this->forward('AppWebBundle:Usuario:Active', array('id'  => $user->getId()  ));

            return $response;
        }else{
            $errors = $this->get('validator')->validate( $form );
            $msgError=new \App\WebBundle\Util\MensajeError();
             $msgError->AddErrors($form);
             $msg=$msgError->getErrorsHTML();
            
           
            return array(
            'result' => "{\"success\":\"false\",\"message\":\"$msg\"}"
             );
        }
      
        
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     * @Route("/new", name="_admin_usuario_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction(Request $request)
    {
        
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
        
        $user = $userManager->createUser();
        $user->setEnabled(true);

        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, new UserEvent($user, $request));

        $form = $formFactory->createForm();
        $form->setData($user);

        return array(
            'form'   => $form->createView()
        );
    }

    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/{id}", name="usuario_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     * @Route("/{id}/edit", name="_admin_usuario_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppWebBundle:Usuario')->find($id);

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        return array(
            'form'   => $form->createView()
        );
    }

    /**
     * Edits an existing Usuario entity.
     *
     * @Route("/{id}/active", name="_admin_usuario_active", options={"expose"=true})
     * @Method("PUT")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function ActiveAction(Request $request, $id)
    {
        
       /*tu codigo debe devolver {result:true,ms:""}*/
        $msg="Se realizó la activación de registro correctamente.";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->getRepository('AppWebBundle:Usuario')->find($id);
            
            if($entity)
            {
                if($entity->getValidaRegistro()!=("1"))
                {
                    //activa el registro de usurio
                    $entity->setValidaRegistro("1");

                    $em->persist($entity);
                    //$em->flush();
                    //preguntar si es evaluador o postulante
                    if($entity->getPerfil()->getNombre()=="Postulante"){
                        $entitypostulante=new Postulante();
                        $entitypostulante->setRazonsocial("");
                        $entitypostulante->SetRuc("");
                        $entitypostulante->setUsuario($entity);
                        $em->persist($entitypostulante);
                        //$em->flush();
                    }
                    if($entity->getPerfil()->getNombre()=="Evaluador"){
                        $entityevaluador=new Evaluador();
                        $entityevaluador->setNombres($entity->getNombres());
                        $entityevaluador->setApellidos($entity->getApellidos());
                        $entityevaluador->SetNumDoc($entity->getNroDocumento());
                        $entityevaluador->setUsuario($entity);
                        $em->persist($entityevaluador);
                       
                    }
                    $em->flush();
                    $this->SendEmailConfirmedActivation($entity);
                    
                     
                }else{
                    $msg="Usuario se encuentra con el registro activo"; 
                    $result=false;
                }
            }else{
                $msg="No se encontró el registro"; 
                $result=false;
            }
            return array(
            'result' => "{\"success\":\"$result\",\"message\":\"$msg\"}"

            );
    }
    /**
     * Edits an existing Usuario entity.
     *
     * @Route("/{id}/update", name="_admin_usuario_update", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppWebBundle:Usuario')->find($id);
        
       
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

       
            $form->bind($request);

            
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $userManager = $this->container->get('fos_user.user_manager');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);

               

               
        
        
       $result='true';
       $msg='';
        return array(
            'result' => "{success:'$result',message:'$msg'}"

        );
    }
    /**
     * Deletes a Usuario entity.
     *
     * @Route("/{id}/delete", name="_admin_usuario_delete", options={"expose"=true})
     * @Method("DELETE")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function deleteAction(Request $request, $id)
    {
       $msg="Se desabilito el registro satisfactoriamente";
            $result=true;
            $em = $this->getDoctrine()->getManager();
            
            $entity = $em->getRepository('AppWebBundle:Usuario')->find($id);
            if($entity)
            {
               
                if($entity->isEnabled())
                    $entity->setEnabled(false);
                else
                     $entity->setEnabled(true);
                $em->persist($entity);
            $em->flush();
            
            }else{
                $msg="No se encontro el registro"; 
                $result=false;
            }
            return array(
            'result' => "{success:'$result',message:'$msg'}"

            );
    }

    /**
     * Creates a form to delete a Usuario entity by id.
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
    
    public function SendEmailConfirmedActivation(Usuario $entity){
        $message = \Swift_Message::newInstance()
                    ->setSubject('Bienvenido a PNC')
                    ->setFrom('nmedinson@gmail.com')
                    ->setTo($entity->getEmail())
                    ->setBody(
                            $this->renderView(
                                'AppWebBundle:Usuario:activationConfirmed.html.twig',
                                array('user' => $entity)
                                ) 
                     );
         $this->get('mailer')->send($message);
        
    }
}
