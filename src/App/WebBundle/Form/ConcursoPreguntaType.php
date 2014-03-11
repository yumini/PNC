<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use App\WebBundle\Entity\CatalogoRepository;
class ConcursoPreguntaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('codigo','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('descripcion','text',array('required' => true,'attr' => array('class'=>'form-control input-small')))
            
            
           
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
        return 'app_webbundle_concursopreguntatype';
    }
}
