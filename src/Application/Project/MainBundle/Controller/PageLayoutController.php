<?php

namespace Application\Project\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Application\Project\MainBundle\Entity\Page;

/**
 * Page controller.
 */
class PageLayoutController extends Controller
{

    /**
     * @Template()
     */
    public function menuAction()
    {
        $array = array();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:Page')->findAll();
        $categores = $em->getRepository('MainBundle:ContentCategory')->findAll();

        foreach ($entities as $page) {
            $array[$page->getUrl()] = $page;
        }

        return array(
            'pages' => $array,
            'categores' => $categores
        );
    }

    /**
     * @Template()
     */
    public function sliderAction()
    {
        $em = $this->getDoctrine()->getManager();
        $webPath = $this->container->getParameter('slider_upload_dir');
        $webPathContent = $this->container->getParameter('content_upload_dir');

        $sliders = $em->getRepository('MainBundle:Slider')->findBy(array());

        return array(
            'sliders' => $sliders,
            'webPathContent' => $webPathContent,
            'webPathSlider' => $webPath,
        );
    }

    /**
     * @Template()
     */
    public function loginAction()
    {
        $array = array();
        $em = $this->getDoctrine()->getManager();
        $csrf_token = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        return array(
            'pages' => $array,
            'csrf_token' => $csrf_token
        );
    }

    /**
     * @Template()
     */
    public function operatorCodeAction()
    {
        $array = array();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:Operator')->findAll();

        return array(
            'pages' => $array,
            'entities' => $entities
        );
    }
}
