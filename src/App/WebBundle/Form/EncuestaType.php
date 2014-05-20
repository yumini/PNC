<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use App\WebBundle\Entity\CatalogoRepository;
class EncuestaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipoEncuesta','entity', array('attr' => array('class'=>'form-control input-small'),'class'=>'App\WebBundle\Entity\Catalogo','property'=>'nombre',  
                    'query_builder' => function(CatalogoRepository $er) {
                        return $er->getTiposEncuestaQueryBuilder();
                        
                    }
            ))
            ->add('titulo','text',array('label'=>'Título','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('descripcion','textarea',array('label'=>'Presentación','required' => true,'attr' => array('class'=>'form-control','rows'=>'4')))
            ->add('maxopciones','text',array('label'=>'Máximo Opciones','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('inicio', 'date', array('label'=>'Fecha Inicio','widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('class'=>'form-control input-small')))
            ->add('fin', 'date', array('label'=>'Fecha Fin','widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('class'=>'form-control input-small')))
             ->add('estado','checkbox')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\Encuesta'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_encuestatype';
    }
}
