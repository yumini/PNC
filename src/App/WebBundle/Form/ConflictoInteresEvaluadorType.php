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
            ->add('razonsocial','text',array('label'=>'Razon Social','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('ruc','text',array('label'=>'RUC','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('fecini', 'date', array('label'=>'Fecha de Inicio','widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('class'=>'form-control input-small')))
            ->add('fecfin', 'date', array('label'=>'Fecha Fin','required' => false,'widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('class'=>'form-control input-small')))
            ->add('detalle','textarea',array('label'=>'Detalle','required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('tipoVinculo','entity', array('class'=>'App\WebBundle\Entity\Catalogo', 'property'=>'nombre', 
                                                   'attr' => array('class'=>'form-control input-small'),
                                                   'query_builder' => function(\App\WebBundle\Entity\CatalogoRepository $er){return $er->createQueryBuilder('c')->where('c.codcatalogo= ?1')->setParameter(1, 'TVI');},
                                                  ))
            ->add('hastalafecha','checkbox')
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
