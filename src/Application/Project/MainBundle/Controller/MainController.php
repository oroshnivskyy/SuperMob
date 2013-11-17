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
        $webPathContent = $this->container->getParameter('content_upload_dir');

        $contents = $em->getRepository('MainBundle:Content')->findBy(array('status'=>Slider::STATUS_ON));
        $entityPage = $em->getRepository('MainBundle:Page')->findOneByUrl('index');

        return $this->render('MainBundle:Main:index.html.twig',
            array(
                'contents' => $contents,
                'webPathContent' => $webPathContent,
                'entityPage' => $entityPage
            ));
    }
}
