<?php

namespace Application\Project\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

<<<<<<< HEAD
use Application\Project\MainBundle\Form\NewsLinkType;
=======
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
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
<<<<<<< HEAD
            ->add('newsLinks', 'collection', array(
                                                  'label' => 'Ссылки к новости',
                                                  'type' => new NewsLinkType(),
                                                  'allow_add' => true,
                                                  'allow_delete' => true,
                                                  'prototype' => true
                                             ));
=======
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
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
