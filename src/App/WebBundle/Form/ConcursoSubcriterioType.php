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
           
            ->add('codigo','text',array('label'=>'Código','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('descripcion','text',array('label'=>'Descripción','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('detalle','text',array('label'=>'Detalle','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('puntaje','text',array('label'=>'Puntaje','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('glosa','textarea',array('label'=>'Glosa','required' => true,'attr' => array('class'=>'form-control','rows'=>'5')))
            ->add('comentario','textarea',array('label'=>'Comentario','required' => true,'attr' => array('class'=>'form-control','rows'=>'5')))
            ->add('proposito','textarea',array('label'=>'Proposito','required' => true,'attr' => array('class'=>'form-control','rows'=>'5')))
            ->add('nota','textarea',array('label'=>'Nota','required' => true,'attr' => array('class'=>'form-control','rows'=>'5')))
            
           
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
