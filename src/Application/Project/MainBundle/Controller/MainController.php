<?php

namespace Application\Project\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Application\Project\MainBundle\Entity\Slider;
use Application\Project\MainBundle\Entity\Content;

class MainController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $webPath = $this->container->getParameter('slider_upload_dir');
        $webPathContent = $this->container->getParameter('content_upload_dir');

        $sliders = $em->getRepository('MainBundle:Slider')->findBy(array());
        $contents = $em->getRepository('MainBundle:Content')->findBy(array('status'=>Slider::STATUS_ON));

//        var_dump( $sliders );exit;

        return $this->render('MainBundle:Main:index.html.twig',
            array(
                'sliders' => $sliders,
                'contents' => $contents,
                'webPathContent' => $webPathContent,
                'webPathSlider' => $webPath
            ));
    }
}
