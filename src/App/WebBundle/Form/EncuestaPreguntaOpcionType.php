<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncuestaPreguntaOpcionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('opcion','text',array('label'=>'Opción','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('peso','text',array('label'=>'Peso','required' => true,'attr' => array('class'=>'form-control input-small')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\EncuestaPreguntaOpcion'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_encuestapreguntaopciontype';
    }
}
