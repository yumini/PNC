<?php
    namespace App\WebBundle\Services;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuBuilder
 *
 * @author Edinson
 */
class ConcursoCriterioService {
    //put your code here
    private $em;
    private $idConcurso;
    public function __construct($em)
    {
        $this->em=$em;
    }
    public function GetTreeJSON($idConcurso){
        $this->idConcurso=$idConcurso;
        $cadena="";
        $entities =  $this->em->getRepository('AppWebBundle:ConcursoCriterio')->FindByParentId($idConcurso,0);
        $cadena.="[";
         $i=0;
        foreach ($entities as $entity) {
            $i++;
            $cadena.=$this->CreateNodeTreeJSON($entity);
            if($i<count($entities))
                $cadena.=',';

        }
        $cadena.="]";
        return $cadena;
    }
    public function CreateNodeTreeJSON(\App\WebBundle\Entity\ConcursoCriterio $entity){
        $cadena="";
        $em = $this->em;
        $entities = $em->getRepository('AppWebBundle:ConcursoCriterio')->FindByParentId($this->idConcurso,$entity->getId());
        if(count($entities)>0){
           $cadena.="{\"id\":\"".$entity->getId()."\",";
           $cadena.="\"codigo\":\"".$entity->getCodigo()."\",";
           $cadena.="\"descripcion\":\"".$entity->getDescripcion()."\",";
           $cadena.="\"tipoArbol\":\"".$entity->getTipoArbolCriterio()->getNombre()."\",";
           $cadena.="\"puntaje\":\"".$entity->getPuntaje()."\",";
           $cadena.="\"children\":[";
           $i=0;
            foreach ($entities as $sub_entity) {
                $i++;
                $cadena.=$this->CreateNodeTreeJSON($sub_entity);
                if($i<count($entities))
                    $cadena.=',';
                
            }
            //$cadena=substr($cadena,0,count($cadena)-1);
            $cadena.="]}";

        }else{
           $cadena.="{\"id\":\"".$entity->getId()."\",";
           $cadena.="\"codigo\":\"".$entity->getCodigo()."\",";
           $cadena.="\"tipoArbol\":\"".$entity->getTipoArbolCriterio()->getNombre()."\",";
           $cadena.="\"descripcion\":\"".$entity->getDescripcion()."\",";
           $cadena.="\"puntaje\":\"".$entity->getPuntaje()."\"";
           $cadena.="}";
        }
        return $cadena;
    }
    
    
}