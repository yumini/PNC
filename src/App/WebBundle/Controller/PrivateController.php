<?php

namespace App\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use App\WebBundle\Menu\MenuBuilder;
use App\WebBundle\Entity\Perfil;
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

        $menuEntity=new MenuBuilder($em,$this->title,$user);
        $menuHTML=$menuEntity->CreateMenu($user->getPerfil()->getId());
        return array(
            'title' => $this->title,
            'Menu' => $menuHTML,
            'user'=>$user
            );
    }
    /**
     * @Route("/inicio", name="_admin_inicio", options={"expose"=true})
     * @Template()
     */
    public function inicioAction()
    {
        $user = $this->container->get("security.context")->getToken()->getUser();
        return array(
            'title' => $this->title,
            'user'=>$user
            );
    }
     /**
     * @Route("/inicioPostulante", name="_admin_inicio_postulante", options={"expose"=true})
     * @Template()
     */
    public function inicioPostulanteAction()
    {
      
        $user = $this->container->get("security.context")->getToken()->getUser();
        return array(
            'title' => $this->title,
            'user' => $user
            );
    }

    /**
     * @Route("/inicioEvaluador", name="_admin_inicio_evaluador", options={"expose"=true})
     * @Template()
     */
    public function inicioEvaluadorAction()
    {
      
        $user = $this->container->get("security.context")->getToken()->getUser();
        return array(
            'title' => $this->title,
            'user' => $user
            );
    }
}

?>