<?php

namespace App\WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\WebBundle\Entity\CriterioAspectoClave;
use App\WebBundle\Entity\AspectoClave;
use App\WebBundle\Entity\ConcursoCriterio;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * CriterioAspectoClave controller.
 *
 * @Route("/admin/criterioaspectoclave")
 */
class CriterioAspectoClaveController extends Controller
{

    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/new", name="_admin_criterioaspectoclave_new", options={"expose"=true})
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
     * Lists all CriterioAspectoClave entities.
     *
     * @Route("/json/rest", name="_admin_json_criterioaspectoclave", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idcriterio=$request->query->get('idcriterio');
        $entities = $em->getRepository('AppWebBundle:CriterioAspectoClave')->findAllByCriterio($idcriterio,true);
        
        return new JsonResponse($entities);
    }
    
    /**
     * Lists all CriterioAspectoClave entities.
     *
     * @Route("/json/rest", name="_admin_json_criterioaspectoclave_save", options={"expose"=true})
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $entity=new CriterioAspectoClave();
        $criterio = $em->getRepository('AppWebBundle:ConcursoCriterio')->find($data['criterio_id']);
        $aspectoclave = $em->getRepository('AppWebBundle:AspectoClave')->find($data['aspectoclave_id']);
       
        $entity->setCriterio($criterio);
        $entity->setAspectoclave($aspectoclave);
        $em->persist($entity);
        $em->flush();
        
        return new JsonResponse(array('success' => true));
    }

    /**
     * Displays a form to create a new Concurso entity.
     *
     * @Route("/json/rest/{id}", name="_admin_criterioaspectoclave_delete", options={"expose"=true})
     * @Method("DELETE")
     * @Template()
     */
    public function deleteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppWebBundle:CriterioAspectoClave')->find($id);
        if($entity)
        {                
            $em->remove($entity);
            $em->flush();

        }
        return new JsonResponse(array('success' => true));
    }
    
}
