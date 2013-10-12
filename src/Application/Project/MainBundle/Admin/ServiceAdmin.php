<?php

namespace Application\Project\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

class ServiceAdmin extends Admin
{
    protected $baseRouteName = 'service_new';
    protected $baseRoutePattern = '/service';

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $types = $this->getConfigurationPool()->getContainer()->getParameter('types');
        $types = array_flip($types);
        $formMapper
            ->add('name', null, array('label' => 'Название', 'required' => true))
            ->add('url', null, array('label' => 'URL', 'required'  => true))
            ->add('status', null, array('label' => 'Активный', 'required'=>false))
            ->add('type', 'choice', array('label' => 'Тип', 'choices'   => $types));
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
            ->addIdentifier('url', null, array('label' => 'URL'))
            ->add('status', null, array('label' => 'Активный'));
    }
}