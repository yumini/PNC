<?php

namespace App\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\AspectoClave;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * AspectoClave controller.
 *
 * @Route("/admin/aspectoclave")
 */
class AspectoClaveController extends Controller
{

    /**
     * Lists all AspectoClave entities.
     *
     * @Route("/json/rest", name="_admin_json_aspectoclave", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $isparent=($request->query->get('isparent')=='true')?true:false;
        $idcriterio=$request->query->get('idcriterio');
        $idconcurso=$request->query->get('idconcurso');
        if(isset($idcriterio)){
            
            $entities = $em->getRepository('AppWebBundle:AspectoClave')->findAllById($idcriterio,$isparent,true);
        }
        if(isset($idconcurso)){
            
            $entities = $em->getRepository('AppWebBundle:AspectoClave')->findAllByConcursoId($idconcurso,true);
        }
        
        return new JsonResponse($entities);
    }


    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/new", name="_admin_aspectoclave_new", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        return array(
            'title' => 'xx'
        );
    }

    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/json/rest", name="_admin_aspectoclave_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $criterio = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($data['criterio_id']);
        $entity  = new AspectoClave();

        $entity->setCriterio($criterio);
        $entity->setDescripcion($data['descripcion']);
        $em->persist($entity);
        $em->flush();
        
        return new JsonResponse(array('success' => true));
    }
    /**
     * Finds and displays a AspectoClave entity.
     *
     * @Route("/{id}", name="aspectoclave_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppWebBundle:AspectoClave')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AspectoClave entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
