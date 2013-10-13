<?php

namespace Application\Project\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

class CodeAdmin extends Admin
{
    protected $baseRouteName = 'code_new';
    protected $baseRoutePattern = '/code';

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('code', null, array('label' => 'Код', 'required' => true))
            ->add('price', null, array('label' => 'Цена', 'required'  => true))
            ->add('status', null, array('label' => 'Активный', 'required'=>false))
            ->add('operator', 'entity', array('label' => 'Оператор', 'required'=>false, 'class'=>'MainBundle:Operator',
                                             'property'=>'name'));
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
            ->addIdentifier('code', null, array('label' => 'Код'))
            ->addIdentifier('price', null, array('label' => 'Цена'))
            ->add('operator.name', 'entity', array('label' => 'Оператор'))
            ->add('createdAt', 'datetime', array('label' => 'Создан'));
    }
}