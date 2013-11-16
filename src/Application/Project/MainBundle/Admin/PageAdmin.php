<?php
namespace Application\Project\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

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

        if($this->getSubject()->getId()){
            $formMapper->add('url', null, array('label' => 'URL', 'required' => true, 'disabled'=>true));
        }else{
            $formMapper->add('url', null, array('label' => 'URL', 'required' => true));
        }
        $formMapper
            ->add('name', null, array('label' => 'Название', 'required' => true))
            ->add('title', null, array('label' => 'Заголовок'))
            ->add('description', 'textarea', array('label' => 'Описание'))
            ->add('text', null, array('label' => 'Текст', 'attr' => array('class' => 'ckeditor')))
            ->add('status', 'checkbox', array('label' => 'Отображать на главной', 'required'  => false));
    }

    /**
     * Конфигурация списка записей
     *
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('name', null, array('label' => 'Название'))
            ->addIdentifier('title', null, array('label' => 'Заголовок'))
            ->add('url', null, array('label' => 'URL'))
            ->add('status', null, array('label' => 'Отображается на главной'));
    }
}
