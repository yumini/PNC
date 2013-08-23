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
class MenuBuilder {
    //put your code here
    private $em;
    private $title;
    private $user;
     public function __construct($em,$title,  \App\WebBundle\Entity\Usuario $user)
    {
        $this->em=$em;
        $this->title=$title;
        $this->user=$user;
    }
    public function CreateMenu($perfilid){
        $cadena="";
        //$em = $this->getDoctrine()->getManager();
        $entities =  $this->em->getRepository('AppWebBundle:Menu')->findByParent($perfilid,0);
         
        $cadena.="<div class=\"navbar  navbar-inverse\">";
        $cadena.="<div class=\"navbar-inner\">";
        $cadena.="<div class=\"container-fluid\">";
        
        $cadena.="<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-inverse-collapse\">";
        $cadena.=" <span class=\"icon-bar\"></span>";
        $cadena.=" <span class=\"icon-bar\"></span>";
        $cadena.=" <span class=\"icon-bar\"></span>";
        $cadena.="</button>";
        $cadena.="<a href=\"#\"  class=\"navbar-brand\"><small><h6 style='margin:0px 0px;padding:0px 0px'>".$this->title."</h6></small></a>";
        $cadena.="<div class=\"nav-collapse collapse navbar-inverse-collapse\">";
        $cadena.="<ul class=\"nav navbar-nav\">";
        foreach ($entities as $entity) {
            $cadena.=$this->CreateSubMenu($perfilid,$entity);
        }
        $cadena.="</ul>";
        $cadena.=$this->GetHTMLConfigMenu();
        $cadena.="</div>";
        $cadena.="</div>";
        $cadena.="</div>";
        $cadena.="</div>";
        return $cadena;
    }
    public function CreateSubMenu($perfilid,\App\WebBundle\Entity\Menu $entity){
        $cadena="";
        $em = $this->em;
        $entities = $em->getRepository('AppWebBundle:Menu')->findByParent($perfilid,$entity->getId());
        if(count($entities)>0){
           $cadena.="<li class=\"dropdown\">";
           $cadena.="<a data-toggle=\"dropdown\" class=\"dropdown-toggle\" href=\"#\">".$entity->getTitulo()." <b class=\"caret\"></b></a>";
           $cadena.=" <ul class=\"dropdown-menu\">";
            foreach ($entities as $sub_entity) {
                
                $cadena.=$this->CreateSubMenu($perfilid,$sub_entity);
                
            }
            $cadena.="</ul>";
            $cadena.="</li>";
        }else{
            
            $cadena.=" <li><a href=\"#\" onclick=\"new jAjax().Load(Routing.generate('".$entity->getUrl()."'),'cuerpo','get','','');return false;\">".$entity->getTitulo()."</a></li>";
        }
        return $cadena;
    }
    public function GetHTMLConfigMenu(){
        $cadena="
         <ul class=\"nav navbar-nav pull-right\">
                      
                      <li class=\"divider-vertical\"></li>
                      <li class=\"dropdown\">
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"glyphicon glyphicon-user icon-white\"> </i> ".$this->user->getUsername()." <b class=\"caret\"></b></a>
                        <ul class=\"dropdown-menu\">
                          <li><a href=\"#\">Mis Datos Personales</a></li>
                          <li><a href=\"#\">Cambiar mi contraseña</a></li>
                          
                          <li class=\"divider\"></li>
                          <li><a href=\"../logout\"><i class=\"glyphicon glyphicon-off\"> </i> Cerrar Sesión</a></li>
                        </ul>
                      </li>
                    </ul>";
        return $cadena;
         
    }
    public function GetHTMLConfigMenuDefault(){
        $cadena="
         <ul class=\"nav navbar-nav pull-right\">
                      
                      <li class=\"divider-vertical\"></li>
                      <li >
                      <a data-toggle=\"modal\" href=\"#myModal\">
                        <i class=\"glyphicon glyphicon-lock icon-white\"> </i> Iniciar Sesion 
                       </a> 
                      </li>
                    </ul>";
        return $cadena;
         
    }
    public function CreateMenuDefault(){
        $cadena="";
        //$em = $this->getDoctrine()->getManager();
        
        $cadena.="<div class=\"navbar navbar-fixed-top navbar-inverse\">";
        $cadena.="<div class=\"navbar-inner\">";
        $cadena.="<div class=\"container-fluid\">";
        
        $cadena.="<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-inverse-collapse\">";
        $cadena.=" <span class=\"icon-bar\"></span>";
        $cadena.=" <span class=\"icon-bar\"></span>";
        $cadena.=" <span class=\"icon-bar\"></span>";
        $cadena.="</button>";
        $cadena.="<a href=\"#\"  class=\"navbar-brand\"><small><h6 style='margin:0px 0px;padding:0px 0px'>".$this->title."</h6></small></a>";
        $cadena.="<div class=\"nav-collapse collapse navbar-inverse-collapse\">";
       
        $cadena.=$this->GetHTMLConfigMenuDefault();
        $cadena.="</div>";
        $cadena.="</div>";
        $cadena.="</div>";
        $cadena.="</div>";
        return $cadena;
    }
    
}

?>
