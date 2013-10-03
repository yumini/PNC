<?php

namespace App\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use App\WebBundle\Menu\MenuBuilder;
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
   
}
