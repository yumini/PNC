<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
class PerfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('nombre','text',array('label'=>'Nombre','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('descripcion','text',array('label'=>'Descripción','required'  => false ,'attr' => array('class'=>'form-control input-small')))
           // ->add('estado','checkbox', array('label' => 'Activo','required'  => false ,'attr' => array('class'=>'checkbox')))
           
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\Perfil'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_perfiltype';
    }
}
