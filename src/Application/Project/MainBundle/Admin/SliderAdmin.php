<?php

namespace Application\Project\MainBundle\Admin;

use Application\Project\MainBundle\Entity\Slider;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

class SliderAdmin extends Admin
{
    protected $baseRouteName = 'slider';
    protected $baseRoutePattern = '/slider';

    public function prePersist($slider) {
        $this->setUploadRootDir($slider);
    }

    public function preUpdate($slider) {
        $this->setUploadRootDir($slider);
    }

    private function setUploadRootDir(Slider $slider) {
        $rootPath = $this->getRequest()->server->get('DOCUMENT_ROOT') . 
            $this->getConfigurationPool()->getContainer()->getParameter('slider_upload_dir');

        $slider->setUploadRootDir($rootPath);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $slider = $this->getSubject();
        $this->setUploadRootDir($slider);

        $fileFieldOptions = array('label' => 'Картинка', 'required' => $slider->getId()?false:true);
        $webPath = $this->getConfigurationPool()->getContainer()->getParameter('slider_upload_dir');
        if ($slider && ($imageName = $slider->getImage())) {
            $fileFieldOptions['help'] = '<img src="'.$webPath.'/'.$imageName.'" class="admin-preview" />';
        }

        $formMapper
            ->add('name', null, array('label' => 'Название', 'required' => true))
            ->add('url', null, array('label' => 'URL', 'required' => true))
            ->add('urlName', null, array('label' => 'Название URL', 'required' => true))
            ->add('text', null, array('label' => 'Текст', 'attr' => array('class' => 'ckeditor')))
            ->add('file', 'file', $fileFieldOptions)
            ->add('status', 'checkbox', array('label' => 'Отображать на главной', 'required'  => false));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('name', null, array('label' => 'Название'))
            ->add('url', null, array('label' => 'Url'))
            ->add('status', null, array('label' => 'Статус'));
    }

}