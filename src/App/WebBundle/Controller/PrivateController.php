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
use Symfony\Component\HttpFoundation\JsonResponse;
/**
* @Route("/admin")
*/
class PrivateController extends Controller {

     private $title="Premio Nacional de la Calidad";
     /**
     * @Route("/getdate", name="_admin_getdate", options={"expose"=true})
     * @Template()
     */
    public function getdateAction(Request $request){
        $showtime=($request->query->get('showtime','true')=='true')?true:false;
        $time=($showtime)?' h:i:s':'';
        return new JsonResponse(array('date' => date("y-m-d$time")));
    }
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
            $em = $this->getDoctrine()->getManager();
            $usercustom=null;
            switch($user->getPerfil()->getId())
            {
                case 3://postulante                    
                    $usercustom = $em->getRepository('AppWebBundle:Postulante')->findByUser($user->getId());
                    break;
                case 2://evaluador
                    $usercustom = $em->getRepository('AppWebBundle:Evaluador')->findByUser($user->getId());
                    break;
            }
            return array(
                'title' => $this->title,
                'Menu' => $menuHTML,
                'user'=>$user,
                'usercustom'=>$usercustom
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
     * @Route("/home/postulante/{id}", name="_admin_inicio_postulante",options={"expose"=true})
     * @Route("/home/postulante/", defaults={"id" = 0})
     * @Template()
     */
    public function inicioPostulanteAction($id=0)
    {
        $access=false;
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
        //echo($id);
        //echo($user->getPerfil()->getId());
        //die();
        switch($user->getPerfil()->getId())
        {
            case 3://postulante
                $em = $this->getDoctrine()->getManager();
                $postulante = $em->getRepository('AppWebBundle:Postulante')->findByUser($user->getId());
                if($id!="0"){
                    if($postulante->getId()==$id)
                        $access=true; 
                }else
                    $access=true;
                break;
            case 1://administrador
                $postulante = $em->getRepository('AppWebBundle:Postulante')->find($id);
                $access=true;
                break;
        }

       
        if($access)
            return array(
                'title' => $this->title,
                'user' => $postulante->getUsuario(),
                'postulante' => $postulante
                );
        else
            return new RedirectResponse($this->generateUrl('accessdenegate'));
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
     * @Route("/home/evaluador/{id}", name="_admin_inicio_evaluador", options={"expose"=true})
     * @Route("/home/evaluador/", defaults={"id" = 0})
     * @Template()
     */
    public function inicioEvaluadorAction($id=0)
    {
      
        $access=false;
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get("security.context")->getToken()->getUser();
        switch($user->getPerfil()->getId())
        {
            case 2://evaluador
                $em = $this->getDoctrine()->getManager();
                $evaluador = $em->getRepository('AppWebBundle:Evaluador')->findByUser($user->getId());
                if($id!="0"){
                    if($evaluador->getId()==$id)
                        $access=true; 
                }else
                    $access=true;
                
                break;
            case 1://administrador
                $evaluador = $em->getRepository('AppWebBundle:Evaluador')->find($id);
                $access=true;
                break;
        }

       
        if($access)
            return array(
                'title' => $this->title,
                'user' => $evaluador->getUsuario(),
                'evaluador' => $evaluador
                );
        else
            return new RedirectResponse($this->generateUrl('accessdenegate'));

       
    }

    
}

?>