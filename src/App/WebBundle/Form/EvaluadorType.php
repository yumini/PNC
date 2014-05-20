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
                
            ->add('nombres','text',array('label'=>'Nombres','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('apellidos','text',array('label'=>'Apellidos','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('evaluadorsexo','entity', array('class'=>'App\WebBundle\Entity\Catalogo', 'property'=>'nombre', 
                                                   'attr' => array('class'=>'form-control input-small'),
                                                   'query_builder' => function(\App\WebBundle\Entity\CatalogoRepository $er){return $er->getTipoSexoQueryBuilder();},
                                                  ))

            ->add('direccion','text',array('label'=>'Dirección','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('numdoc','text',array('label'=>'N° Documento','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('curriculum','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('empresa','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))            
            ->add('cargo','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))            
            ->add('direccionempresa','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('distritoemp','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))    
            ->add('telefonoemp','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('faxemp','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('emailemp','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('distrito','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('telefono','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('celular','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
//            ->add('foto','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('profesion','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('especializacion','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('email1','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('email2','text',array('required' => false,'attr' => array('class'=>'form-control input-small')))
            ->add('disponibleviaje','checkbox')
            ->add('disponiblereunion','checkbox')
            ->add('estadotermino','checkbox')
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
