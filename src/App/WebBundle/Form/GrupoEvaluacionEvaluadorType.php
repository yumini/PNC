<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GrupoEvaluacionEvaluadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaRegistro')
            ->add('fechaActualizacion')
            ->add('grupo')
            ->add('evaluador')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\GrupoEvaluacionEvaluador'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_grupoevaluacionevaluadortype';
    }
}
