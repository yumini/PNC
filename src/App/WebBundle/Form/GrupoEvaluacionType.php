<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GrupoEvaluacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('concurso','entity', array('label'=>'Concurso','attr' => array('class'=>'form-control input-small'),'class'=>'App\WebBundle\Entity\Concurso', 'property'=>'nombre', ))
            ->add('nombre','text',array('label'=>'Nombre','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('descripcion','textarea',array('label'=>'Descripción','required' => false,'attr' => array('class'=>'form-control','rows'=>'4')))
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\GrupoEvaluacion'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_grupoevaluaciontype';
    }
}
