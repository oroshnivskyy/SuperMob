<?php
namespace Application\Project\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class PageAdmin extends Admin
{
    protected $baseRouteName = 'pages';
    protected $baseRoutePattern = '/page';

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, array('label' => 'Название', 'required' => true))
            ->add('url', null, array('label' => 'URL', 'required' => true))
            ->add('title', null, array('label' => 'Заголовок'))
            ->add('description', 'textarea', array('label' => 'Описание'))
            ->add('text', null, array('label' => 'Текст', 'attr' => array('class' => 'ckeditor')))
            ->add('status', 'checkbox', array('label' => 'Статус', 'required'  => false));
    }
}
