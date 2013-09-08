<?php
namespace Application\Project\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class NewsLinkAdmin extends Admin
{
    protected $baseRouteName = 'news_link';
    protected $baseRoutePattern = '/news_link';

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('url', null, array('label' => 'URL', 'required' => true))
            ->add('text', null, array('label' => 'Описание'));
    }
}
