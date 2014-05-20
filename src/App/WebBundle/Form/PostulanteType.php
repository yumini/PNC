<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostulanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('razonsocial','text',array('label'=>'Razon Social','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('direccion','text',array('label'=>'Dirección','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('ruc','text',array('label'=>'RUC','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('telefono','text',array('label'=>'Teléfono','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('web','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('fax','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\Postulante'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_postulantetype';
    }
}
