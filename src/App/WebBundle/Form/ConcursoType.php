<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConcursoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('fechaInicio', 'date', array('widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('class'=>'form-control input-small')))
            ->add('fechaFin', 'date', array('widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('class'=>'form-control input-small')))
            ->add('presentacion','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'9')))
            ->add('anio','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('estadoemp','checkbox')
            ->add('estadopy','checkbox')
            ->add('estado')
            ->add('terminoacepta','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'9')))
            ->add('incpuntaje','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('evaluacriterio','choice', array('choices'   => array('1' => 'Si', '0' => 'No'),'required'  => true,'attr' => array('class'=>'form-control input-small')))
            ->add('informeretro','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'9')))
            ->add('calificacion','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'9')))
            ->add('prefijo')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\Concurso'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_concursotype';
    }
}