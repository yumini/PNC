<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use App\WebBundle\Entity\CatalogoRepository;
class ConcursoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipoConcurso','entity', array('attr' => array('class'=>'form-control input-small'),'class'=>'App\WebBundle\Entity\Catalogo','property'=>'nombre',  
                    'query_builder' => function(CatalogoRepository $er) {
                        return $er->getTipoConcursosQueryBuilder();
                        
                    }
            ))
            ->add('nombre','text',array('label'=>'Nombre','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('fechaInicio', 'date', array('label'=>'Fecha Inicio','widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('class'=>'form-control input-small')))
            ->add('fechaFin', 'date', array('label'=>'Fecha Fin','widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('class'=>'form-control input-small')))
            ->add('presentacion','textarea',array('label'=>'Presentación','required' => true,'attr' => array('class'=>'form-control','rows'=>'9')))
            ->add('anio','text',array('label'=>'Año','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('estadoemp','checkbox')
            ->add('estadopy','checkbox')
            ->add('estado')
            ->add('terminoacepta','textarea',array('label'=>'Terminos de Aceptación','required' => true,'attr' => array('class'=>'form-control','rows'=>'9')))
            ->add('incpuntaje','text',array('label'=>'Incremento de Puntaje','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('evaluacriterio','choice', array('choices'   => array('1' => 'Si', '0' => 'No'),'required'  => true,'attr' => array('class'=>'form-control input-small')))
            ->add('informeretro','textarea',array('label'=>'Informe Retroalimentación','required' => true,'attr' => array('class'=>'form-control','rows'=>'9')))
            ->add('calificacion','textarea',array('label'=>'Calificación','required' => true,'attr' => array('class'=>'form-control','rows'=>'9')))
            ->add('prefijo')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\Concurso'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_concursotype';
    }
}
