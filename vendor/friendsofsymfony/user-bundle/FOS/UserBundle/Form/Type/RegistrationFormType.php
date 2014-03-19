<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('perfil','entity', array('class'=>'App\WebBundle\Entity\Perfil', 'property'=>'nombre' ))
            ->add('tipoDocumento','entity', array('class'=>'App\WebBundle\Entity\Catalogo', 'property'=>'nombre', 
                                                   'attr' => array('class'=>'form-control input-small'),
                                                   'query_builder' => function(\App\WebBundle\Entity\CatalogoRepository $er){return $er->getTipoDocumentoIdentidadQueryBuilder();},
                                                  ))
            ->add('nroDocumento','text',array('label' => 'N° Documento'))
            ->add('nombres')
            ->add('apellidos')
            ->add('username', null, array('label' => 'Nombre de Usuario'))
            ->add('email', 'email', array('label' => 'Email'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'label' => 'Contraseña',
                'options' => array('attr' => array('class'=>'form-control input-small')),
                'first_options' => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repita la contraseña:'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention'  => 'registration',
        ));
    }

    public function getName()
    {
        return 'fos_user_registration';
    }
}
