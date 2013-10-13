<?php

namespace Application\Project\MainBundle\Admin;

use Application\Project\MainBundle\Entity\Operator;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

class OperatorAdmin extends Admin
{
    protected $baseRouteName = 'operator_new';
    protected $baseRoutePattern = '/operator';

    private function setUploadRootDir(Operator $slider) {
        $rootPath = $this->getRequest()->server->get('DOCUMENT_ROOT') .
            $this->getConfigurationPool()->getContainer()->getParameter('operator_upload_dir');

        $slider->setUploadRootDir($rootPath);
    }
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $operator = $this->getSubject();
        $this->setUploadRootDir($operator);

        $fileFieldOptions = array('label' => 'Картинка', 'required' => $operator->getId()?false:true);
        $webPath = $this->getConfigurationPool()->getContainer()->getParameter('operator_upload_dir');
        if ($operator && ($imageName = $operator->getImage())) {
            $fileFieldOptions['help'] = '<img src="'.$webPath.'/'.$imageName.'" class="admin-preview" />';
        }
        $countries = $this->getConfigurationPool()->getContainer()->getParameter('countries');
        $countries = array_flip($countries);
        $formMapper
            ->add('name', null, array('label' => 'Название', 'required' => true))
            ->add('url', null, array('label' => 'URL', 'required'  => true))
            ->add('status', null, array('label' => 'Активный', 'required'=>false))
            ->add('country', 'choice', array('label' => 'Страна', 'choices'   => $countries))
            ->add('file', 'file', $fileFieldOptions);
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