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
            ->add('razonsocial')
            ->add('direccion')
            ->add('ruc')
            ->add('telefono')
            ->add('web')
            ->add('fax')
            ->add('fechaCreacion')
            ->add('fechaActualizacion')
            ->add('usuario')
            ->add('grupos')
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
