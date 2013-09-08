<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConflictoInteresEvaluadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('razonsocial')
            ->add('ruc')
            ->add('fecini')
            ->add('fecfin')
            ->add('detalle')
            ->add('tipoVinculo','entity', array('class'=>'App\WebBundle\Entity\Catalogo', 'property'=>'nombre', 
                                                   'attr' => array('class'=>'form-control input-small'),
                                                   'query_builder' => function(\App\WebBundle\Entity\CatalogoRepository $er){return $er->createQueryBuilder('c')->where('c.codcatalogo= ?1')->setParameter(1, 'TVI');},
                                                  ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\ConflictoInteresEvaluador'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_conflictointeresevaluadortype';
    }
}
