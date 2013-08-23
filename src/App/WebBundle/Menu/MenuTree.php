<?php
namespace App\WebBundle\Menu;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuBuilder
 *
 * @author Edinson
 */
class MenuTree {
    //put your code here
    private $em;
    public function __construct($em)
    {
        $this->em=$em;
    }
    public function GetTreeJSON(){
        $cadena="";
        $entities =  $this->em->getRepository('AppWebBundle:Menu')->FindByParentId(0);
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
    public function CreateNodeTreeJSON(\App\WebBundle\Entity\Menu $entity){
        $cadena="";
        $em = $this->em;
        $entities = $em->getRepository('AppWebBundle:Menu')->FindByParentId($entity->getId());
        if(count($entities)>0){
           $cadena.="{\"id\":\"".$entity->getId()."\",";
           $cadena.="\"text\":\"".$entity->getTitulo()."\",";
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
           $cadena.="\"text\":\"".$entity->getTitulo()."\"";
           $cadena.="}";
        }
        return $cadena;
    }
    
    
}

?>
