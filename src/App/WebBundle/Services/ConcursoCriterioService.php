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
    private $nivel;
    private $countnivel;
    public function __construct($em)
    {
        $this->em=$em;
        $this->countnivel=0;
    }
    public function GetTreeJSON($idConcurso,$nivel){
        $this->nivel=$nivel;
        $this->idConcurso=$idConcurso;
        $cadena="";
        $entities =  $this->em->getRepository('AppWebBundle:ConcursoCriterio')->FindByParentId($idConcurso,0);
        $cadena.="[";
         $i=0;
        foreach ($entities as $entity) {
            $this->countnivel=0;
            $i++;
            $cadena.=$this->CreateNodeTreeJSON($entity);
            if($i<count($entities))
                $cadena.=',';

        }
        $cadena.="]";
        return $cadena;
    }
    public function CreateNodeTreeJSON(\App\WebBundle\Entity\ConcursoCriterio $entity){
      $this->countnivel++;
      $cadena="";
      
        
        $em = $this->em;
        $entities = $em->getRepository('AppWebBundle:ConcursoCriterio')->FindByParentId($this->idConcurso,$entity->getId());
        if(count($entities)>0){
           $cadena.="{\"id\":\"".$entity->getId()."\",";
           $cadena.="\"codigo\":\"".$entity->getCodigo()."\",";
           $cadena.="\"text\":\"".$entity->getDescripcion()."\",";
           $cadena.="\"descripcion\":\"".$entity->getDescripcion()."\",";
           $cadena.="\"concurso_id\":\"".$entity->getConcurso()->getId()."\",";
           $cadena.="\"tipoArbol\":\"".$entity->getTipoArbolCriterio()->getNombre()."\",";
           $cadena.="\"tipoArbol_id\":\"".$entity->getTipoArbolCriterio()->getCodigo()."\",";
           if($this->countnivel==1){
              $cadena.="\"tipoCriterio\":\"".$entity->getTipoCriterio()->getNombre()."\",";
              $cadena.="\"tipoCriterio_id\":\"".$entity->getTipoCriterio()->getCodigo()."\",";
           }
           $cadena.="\"puntaje\":\"".$entity->getPuntaje()."\",";
           $cadena.="\"tipoOpciones\":\"".$entity->getId().'-'.$entity->getTipoArbolCriterio()->getCodigo()."\",";
           $cadena.="\"children\":[";
           if($this->countnivel<=$this->nivel || $this->nivel==0){
              $i=0;
           
              foreach ($entities as $sub_entity) {
                  $i++;
                  $cadena.=$this->CreateNodeTreeJSON($sub_entity);
                  if($i<count($entities))
                      $cadena.=',';
                  
              }
            }
            //$cadena=substr($cadena,0,count($cadena)-1);
            $cadena.="]}";

        }else{
           $cadena.="{\"id\":\"".$entity->getId()."\",";
           $cadena.="\"codigo\":\"".$entity->getCodigo()."\",";
           $cadena.="\"concurso_id\":\"".$entity->getConcurso()->getId()."\",";
           $cadena.="\"tipoArbol\":\"".$entity->getTipoArbolCriterio()->getNombre()."\",";
           $cadena.="\"tipoArbol_id\":\"".$entity->getTipoArbolCriterio()->getCodigo()."\",";
           if($this->countnivel==1){
              $cadena.="\"tipoCriterio\":\"".$entity->getTipoCriterio()->getNombre()."\",";
              $cadena.="\"tipoCriterio_id\":\"".$entity->getTipoCriterio()->getCodigo()."\",";
           }
           $cadena.="\"text\":\"".$entity->getDescripcion()."\",";
           $cadena.="\"descripcion\":\"".$entity->getDescripcion()."\",";
           $cadena.="\"puntaje\":\"".$entity->getPuntaje()."\",";
           $cadena.="\"tipoOpciones\":\"".$entity->getId().'-'.$entity->getTipoArbolCriterio()->getCodigo()."\"";
           
           $cadena.="}";
        }
      
      return $cadena;
    }
    
    
}