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
    private $msg;
    public function addError($message)
    {
        $this->errors[] = $message;
    
        return $this;
    }
    public function __construct()
    {
        $this->errors = new \Doctrine\Common\Collections\ArrayCollection();
       
    }
    public function AddErrors(\Symfony\Component\Form\Form $form){
         $this->errors=$this->getErrorMessages($form);
    }
    
    public function getErrorsHTML(){
        
        return $this->msg;
    }
   public function getErrorMessages(\Symfony\Component\Form\Form $form) {
        $errors = array();
        $this->msg.='<br/>';
        foreach ($form->getErrors() as $key => $error) {
                $errors[] = $error->getMessage();
                $this->msg.=$error->getMessage().'<br/>';
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                 $options = $child->getConfig()->getOptions();
                 $this->msg.='<b>'.$options['label'].':</b>';
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }
}

?>
