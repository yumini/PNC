<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use App\WebBundle\Entity\CatalogoRepository;
class ConcursoCriterioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('tipoCriterio','entity', array('attr' => array('class'=>'form-control input-small'),'class'=>'App\WebBundle\Entity\Catalogo','property'=>'nombre',  
                    'query_builder' => function(CatalogoRepository $er) {
                        return $er->getTipoCriteriosQueryBuilder();
                        
                    }
            ))
            ->add('codigo','text',array('label'=>'Código','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('descripcion','text',array('label'=>'Descripción','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('puntaje','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('glosa','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'5')))
            ->add('comentario','textarea',array('required' => true,'attr' => array('class'=>'form-control','rows'=>'5')))
            
           
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
        return 'app_webbundle_concursocriteriotype';
    }
}
