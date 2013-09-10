<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CatalogoType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('codcatalogo','hidden', array('required'  => false))
            ->add('nombre','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('estado','checkbox')
            ->add('descripcion','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'9')))
            ->add('abreviatura','text',array('attr' => array('class'=>'form-control input-small')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\Catalogo'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_catalogotype';
    }
}
