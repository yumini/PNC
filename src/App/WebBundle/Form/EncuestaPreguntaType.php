<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use App\WebBundle\Entity\CatalogoRepository;
class EncuestaPreguntaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grupo','entity', array('attr' => array('class'=>'form-control input-small'),'class'=>'App\WebBundle\Entity\Catalogo','property'=>'nombre',  
                    'query_builder' => function(CatalogoRepository $er) {
                        return $er->getGrupoPreguntaQueryBuilder();
                        
                    }
            ))
            ->add('pregunta','text',array('label'=>'Pregunta','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('descripcion','textarea',array('label'=>'Descripción','required' => false,'attr' => array('class'=>'form-control','rows'=>'3')))
            ->add('orden','text',array('label'=>'Orden','required' => true,'attr' => array('class'=>'form-control input-small col-md-3')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\EncuestaPregunta'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_encuestapreguntatype';
    }
}
