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
        $em = $this->getDoctrine()->getManager();
        $postulante = $em->getRepository('AppWebBundle:Postulante')->findByUser($user->getId());
        return array(
            'title' => $this->title,
            'user' => $user,
            'postulante' => $postulante
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

    /**
     *
     * @Route("/upload/postulante/new", name="_admin_postulante_upload", options={"expose"=true})
     * @Method("POST")
     * @Template("AppWebBundle:Default:result.json.twig")
     */
    public function uploadAction(Request $request)
    {
        
       $allowed = array('jpg', 'jpeg', 'png','bmp');
       if(isset($_FILES['filePerfil']) && $_FILES['filePerfil']['error'] == 0){

            $extension = pathinfo($_FILES['filePerfil']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($extension), $allowed)){
               $result="error";
            }

            if(move_uploaded_file($_FILES['filePerfil']['tmp_name'], 'uploads/user.jpg')){
               $result="success";
            }
        }

        return array(
            'result' => "{status:$result}"
        );
    }
}

?>