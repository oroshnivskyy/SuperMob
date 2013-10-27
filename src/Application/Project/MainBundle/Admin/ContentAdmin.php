<?php

namespace Application\Project\MainBundle\Admin;

use Application\Project\MainBundle\Entity\Content;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

class ContentAdmin extends Admin
{
    protected $baseRouteName = 'content_new';
    protected $baseRoutePattern = '/content';

    private function setUploadRootDir(Content $slider) {
        $rootPath = $this->getRequest()->server->get('DOCUMENT_ROOT') .
            $this->getConfigurationPool()->getContainer()->getParameter('content_upload_dir');

        $slider->setUploadRootDir($rootPath);
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $content = $this->getSubject();
        $this->setUploadRootDir($content);

        $fileFieldOptions = array('label' => 'Картинка', 'required' => $content->getId()?false:true);
        $webPath = $this->getConfigurationPool()->getContainer()->getParameter('content_upload_dir');
        if ($content && ($imageName = $content->getImage())) {
            $fileFieldOptions['help'] = '<img src="'.$webPath.'/'.$imageName.'" class="admin-preview" style="max-width:150px"/>';
        }
        $formMapper
            ->add('name', null, array('label' => 'Название', 'required' => true))
            ->add('url', null, array('label' => 'URL', 'required'  => true))
            ->add('shortText', null, array('label' => 'Короткий текст', 'required' => true))
            ->add('bigText', null, array('label' => 'Биг текст', 'attr' => array('class' => 'ckeditor')))
            ->add('status', null, array('label' => 'Активный', 'required'=>false))
            ->add('type', 'choice', array('label' => 'Тип', 'choices'   => array(1 => 'link')))
            ->add('code', null, array('label' => 'Код', 'required'  => false, 'disabled'=>true))
            ->add('price', null, array('label' => 'Цена', 'required'  => true))
            ->add('service', 'entity', array('label' => 'Сервис', 'required'  => true, 'class'=>'MainBundle:Service',
                                             'property'=>'name'))
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
            ->addIdentifier('shortText', null, array('label' => 'Короткий текст'))
            ->add('status', null, array('label' => 'Статус'))
            ->add('price', null, array('label' => 'Цена'));
    }
}