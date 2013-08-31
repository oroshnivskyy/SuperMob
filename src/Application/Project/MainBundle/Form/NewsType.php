<?php

namespace Application\Project\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Заголовок'))
            ->add('announce', 'textarea', array('label' => 'Анонс'))
            ->add('text', 'textarea', array('label' => 'Текст'))
            ->add('pubDate', null, array('label' => 'Дата новости'))
            ->add('newsCategory', null, array('label' => 'Категория'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\Project\MainBundle\Entity\News'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'application_project_mainbundle_news';
    }
}
