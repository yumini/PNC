<?php

namespace App\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use App\WebBundle\Menu\MenuBuilder;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


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
use Symfony\Component\HttpFoundation\JsonResponse;
/**
* @Route("/")
*/
class DefaultController extends Controller
{
    private $title="Bienvenido";
    /**
     * @Route("/", name="_index", options={"expose"=true})
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=new \App\WebBundle\Entity\Usuario();
        $menuEntity=new MenuBuilder($em,$this->title,$user);
        $menuHTML=$menuEntity->CreateMenuDefault();

        return array(
            'title' => $this->title,
            'Menu' => $menuHTML
            );
    }

    /**
     * Creates a new Usuario entity.
     *
     * @Route("/validateregister", name="_usuario_validateregister", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function validateregisterAction(Request $request)
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
            
            $success=true;
        }else{
            $errors = $this->get('validator')->validate( $form );
            $msgError=new \App\WebBundle\Util\MensajeError();
            $msgError->AddErrors($form);
            $msg=$msgError->getErrorsHTML();
             $success=false;
        }
      
        return new JsonResponse(array('success'=>$success,'message'=>$msg));
    }

    /**
     * Creates a new Usuario entity.
     *
     * @Route("/validatelogin", name="_usuario_validatelogin", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $username=$request->query->get('_username');
        $password=$request->query->get('_password');
        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository('AppWebBundle:Usuario')->findOneByUsername($username);
        if($user){
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $passwordEncrypt = $encoder->encodePassword($password, $user->getSalt());

            if($passwordEncrypt==$user->getPassword()){
                if($user->getValidaregistro()==1){
                    $message="Usuario correcto";
                    $success=true;
                }else{
                    $message="<b>Validacion:</b><br/>Lo sentimos, aun no ha sido dado de  alta";    
                    $success=false;
                }
            }else{
                $message="<b>Validacion:</b><br/>Usuario o Contraseña incorrectos";    
                $success=false;
            }
        }else{
            $message="<b>Validacion:</b><br/>Usuario o Contraseña incorrectos";
            $success=false;
        }
        

        return new JsonResponse(array('success'=>$success,'message'=>$message));
       
   }
}
