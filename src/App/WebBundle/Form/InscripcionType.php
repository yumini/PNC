<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InscripcionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreproyecto','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('nombrecorto','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('nombreequipo','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('integrantes','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'5')))
            ->add('objetivoproyecto','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'9')))
            ->add('fechainiciopy', 'date', array('widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('class'=>'form-control input-small')))
            ->add('fechafinpy', 'date', array('widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('class'=>'form-control input-small')))
            
            ->add('terminoaceptacion')
           
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\Inscripcion'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_inscripciontype';
    }
}
