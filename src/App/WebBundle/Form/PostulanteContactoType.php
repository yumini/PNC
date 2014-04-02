<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use App\WebBundle\Entity\CatalogoRepository;
class PostulanteContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text',array('label'=>'Nombre','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('cargo','text',array('label'=>'Cargo','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('telefono','text',array('label'=>'Teléfono','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('fax','text',array('label'=>'Fax','required' => true,'attr' => array('class'=>'form-control input-small')))
            ->add('email','text',array('label'=>'Email','required' => true,'attr' => array('class'=>'form-control input-small')))
            //->add('postulantecontacto')
            ->add('postulantecontacto','entity', array('attr' => array('class'=>'form-control input-small'),'class'=>'App\WebBundle\Entity\Catalogo','property'=>'nombre',  
                    'query_builder' => function(CatalogoRepository $er) {
                        return $er->getTipoContactosQueryBuilder();
                        
                    }
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\WebBundle\Entity\PostulanteContacto'
        ));
    }

    public function getName()
    {
        return 'app_webbundle_postulantecontactotype';
    }
}
