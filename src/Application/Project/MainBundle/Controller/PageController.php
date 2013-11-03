<?php

namespace Application\Project\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Application\Project\MainBundle\Entity\Page;
use Application\Project\MainBundle\Form\PageType;

/**
 * Page controller.
 *
 * @Route("/page")
 */
class PageController extends Controller
{

    /**
     * @Method("GET")
     * @Template()
     */
    public function showAction($url)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MainBundle:Page')->findOneByUrl($url);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return array(
            'entity'      => $entity
        );
    }

    /**
     * @Method("GET")
     * @Template()
     */
    public function categoryAction($url)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MainBundle:ContentCategory')->findOneByNameEn($url);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $contents = $em->getRepository('MainBundle:Content')->findBy(array('category'=>$entity->getId(), 'status'=>true));

        $webPath = $this->container->getParameter('slider_upload_dir');
        $webPathContent = $this->container->getParameter('content_upload_dir');

        return array(
            'entity'      => $entity,
            'contents'    => $contents,
            'webPathContent' => $webPathContent,
            'webPathSlider' => $webPath
        );
    }

    /**
     * @Method("GET")
     * @Template()
     */
    public function productAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MainBundle:Content')->findOneById($id);
        if (!$entity) {
            throw $this->createNotFoundException('Невозможно найти такой продукт');
        }

        $webPath = $this->container->getParameter('slider_upload_dir');
        $webPathContent = $this->container->getParameter('content_upload_dir');

        return array(
            'entity'      => $entity,
            'webPathContent' => $webPathContent,
            'webPathSlider' => $webPath
        );
    }
}
