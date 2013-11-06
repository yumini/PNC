<?php
namespace App\WebBundle\Util;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MensajeError
 *
 * @author Edinson
 */
class MensajeError {
    private $errors;
    
    public function addError($message)
    {
        $this->errors[] = $message;
    
        return $this;
    }
    public function __construct()
    {
        $this->errors = new \Doctrine\Common\Collections\ArrayCollection();
       
    }
    public function AddErrors($arrayErrors){
         foreach( $arrayErrors as $error )
            {
                $msg=$error->getMessage() ;
                $this->addError($msg);
            }
    }
    public function getErrorsHTML(){
        $msg='';
        foreach( $this->errors as $error )
        {
            $msg.='- '.$error.'<br/>' ;

        }
        return $msg;
    }
}

?>
