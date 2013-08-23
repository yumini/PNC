<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvaluadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres')
            ->add('apellidos')
            ->add('direccion')
            ->add('numdoc')
            ->add('sexo')
            ->add('curriculum')
            ->add('empresa')
            ->add('cargo')
            ->add('direccionempresa')
            ->add('distritoemp')
            ->add('telefonoemp')
            ->add('faxemp')
            ->add('emailemp')
            ->add('distrito')
            ->add('telefono')
            ->add('celular')
            ->add('foto')
            ->add('profesion')
            ->add('especializacion')
            ->add('email1')
            ->add('email2')
            ->add('disponibleviaje')
            ->add('disponiblereunion')
            ->add('estadotermino')
            //->add('fechaCreacion')
            //->add('fechaActualizacion')
            //->add('grupos')
            //->add('usuario')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\Evaluador'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_evaluadortype';
    }
}
