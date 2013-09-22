<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use App\WebBundle\Entity\CatalogoRepository;
class ConcursoSubcriterioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('codigo','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('descripcion','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('detalle','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('puntaje','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('glosa','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'5')))
            ->add('comentario','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'5')))
            ->add('proposito','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'5')))
            ->add('nota','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'5')))
            
           
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\ConcursoCriterio'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_concursosubcriteriotype';
    }
}
