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

}
