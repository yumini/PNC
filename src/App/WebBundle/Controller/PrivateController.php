<?php

namespace App\WebBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\SecurityExtraBundle\Annotation\Secure;
use App\WebBundle\Menu\MenuBuilder;
use App\WebBundle\Entity\Perfil;
use Symfony\Component\HttpFoundation\RedirectResponse;
/**
* @Route("/admin")
*/
class PrivateController extends Controller {

     private $title="Premio Nacional de la Calidad";
    /**
     * @Route("/", name="_admin_index", options={"expose"=true})
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
  
        $user = $em->getRepository('AppWebBundle:Usuario')->find($user->getId());
        if($user->getValidaregistro()=="1"){
            $menuEntity=new MenuBuilder($em,$this->title,$user,$this);
            $menuHTML=$menuEntity->CreateMenu($user->getPerfil()->getId());
            return array(
                'title' => $this->title,
                'Menu' => $menuHTML,
                'user'=>$user
                );
        }else{
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        
    }
    /**
     * @Route("/inicio", name="_admin_inicio", options={"expose"=true})
     * @Template()
     */
    public function inicioAction()
    {
        $user = $this->container->get("security.context")->getToken()->getUser();
        if($user->getPerfil()->getId()==1){
            return array(
                'title' => $this->title,
                'user'=>$user
                );
        }else{
            return new RedirectResponse($this->generateUrl('accessdenegate'));
        }
    }
     /**
     * @Route("/inicioPostulante", name="_admin_inicio_postulante", options={"expose"=true})
     * @Template()
     */
    public function inicioPostulanteAction()
    {
      
        $user = $this->container->get("security.context")->getToken()->getUser();
        if($user->getPerfil()->getId()==3){
            $em = $this->getDoctrine()->getManager();
            $postulante = $em->getRepository('AppWebBundle:Postulante')->findByUser($user->getId());
            return array(
                'title' => $this->title,
                'user' => $user,
                'postulante' => $postulante
                );
        }else{
            return new RedirectResponse($this->generateUrl('accessdenegate'));
        }
    }
    
    /**
     * @Route("/accessdenegate", name="accessdenegate", options={"expose"=true})
     * @Template()
     */
    public function accessdenegateAction()
    {

        return array(
            'title' => 'Acceso Denegado para el usuario'
            );
    }
    /**
     * @Route("/inicioEvaluador", name="_admin_inicio_evaluador", options={"expose"=true})
     * @Template()
     */
    public function inicioEvaluadorAction()
    {
      
        $user = $this->container->get("security.context")->getToken()->getUser();
        if($user->getPerfil()->getId()==2){
            $em = $this->getDoctrine()->getManager();
            $evaluador = $em->getRepository('AppWebBundle:Evaluador')->findByUser($user->getId());
            return array(
                'title' => $this->title,
                'user' => $user,
                'evaluador' => $evaluador
                );
        }else{
            return new RedirectResponse($this->generateUrl('accessdenegate'));
        }
    }

    
}

?>