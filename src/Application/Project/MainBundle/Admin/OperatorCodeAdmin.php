<?php

namespace Application\Project\MainBundle\Admin;

use Application\Project\MainBundle\Entity\OperatorCode;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class OperatorCodeAdmin extends Admin{
    protected $baseRouteName = 'operator_code_new';
    protected $baseRoutePattern = '/operator-code';
    protected function configureFormFields( FormMapper $formMapper ){
        $formMapper
            ->add( 'code', null, array('label' => 'Код'))
            ->add( 'status',
                null,
                array( 'label' => 'Активный', 'required' => false)
            );

        if (!is_numeric($formMapper->getFormBuilder()->getForm()->getName())){
            $formMapper
                ->add( 'operator', 'entity',
                    array( 'label' => 'Оператор',
                           'property' => 'name',
                           'class' => 'MainBundle:Operator',
                    )
                );
        }
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('code', null, array('label' => 'Код'))
            ->add('operator.name', 'entity', array('label' => 'Оператор'))
            ->add('status', null, array('label' => 'Активный'));
    }
}
 