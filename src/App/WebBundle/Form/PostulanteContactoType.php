<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostulanteContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('cargo')
            ->add('telefono')
            ->add('fax')
            ->add('email')
            ->add('postulantecontacto')
            ->add('postulante')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\PostulanteContacto'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_postulantecontactotype';
    }
}
