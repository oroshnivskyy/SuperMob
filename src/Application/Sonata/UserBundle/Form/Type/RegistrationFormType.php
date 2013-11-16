<?php
namespace Application\Sonata\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
//            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
//            ->add('email', 'email', array('label' => '123', 'translation_domain' => 'FOSUserBundle'))
            ->add('country', 'choice',
                  array('label' => 'Страна',
                        'expanded' => 'radio',
//                        'requer' => true,
                        'choices' =>
                        array(
                            '2' => 'Украина',
                            '1' => 'Россия'
                        )))
            ->add('operator', 'hidden',array())
//            ->add('plainPassword', 'repeated', array(
//                'type' => 'password',
//                'options' => array('translation_domain' => 'FOSUserBundle'),
//                'first_options' => array('label' => 'form.password'),
//                'second_options' => array('label' => 'form.password_confirmation'),
//                'invalid_message' => 'fos_user.password.mismatch',
//            ))
        ;
    }

    public function getName()
    {
        return 'sonata_user_registration';
    }
}
