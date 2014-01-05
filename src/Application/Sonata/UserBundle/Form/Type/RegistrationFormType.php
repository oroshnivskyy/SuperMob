<?php
namespace Application\Sonata\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Doctrine\ORM\EntityRepository;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('country', 'choice',
                  array('label' => 'Страна:',
                        'expanded' => 'radio',
                        'preferred_choices' => [2],
                        'choices' =>
                        array(
                            '2' => 'Украина',
                            '1' => 'Россия'
                        )));
        $country = $builder->getAttribute('country',2);
        $builder->add('operator', 'entity',
                array(
                        'class'=> 'MainBundle:Operator',
                        'property' => 'name',
                        'label' => 'Оператор:',
                   ))
        ;
    }

    public function getName()
    {
        return 'sonata_user_registration';
    }
}
