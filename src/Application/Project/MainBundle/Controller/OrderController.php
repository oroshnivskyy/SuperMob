<?php

namespace Application\Project\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Order controller.
 *
 * @Route("/order")
 */
class OrderController extends Controller
{

    /**
     * Lists all orders entities.
     *
     * @Route("/", name="orders")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        return array(
//            'entities' => $entities,
        );
    }

    /**
     *
     * @Template()
     */
    public function newAction($id_product)
    {

        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MainBundle:Content')->findOneById($id_product);

        if (!$entity) {
            throw $this->createNotFoundException('Невозможно найти такой продукт');
        }

        $webPath = $this->container->getParameter('slider_upload_dir');
        $webPathContent = $this->container->getParameter('content_upload_dir');

        return array(
            'entity'      => $entity,
            'webPathContent' => $webPathContent,
            'webPathSlider' => $webPath,
            'user' => $this->getUser()
        );
    }

    /**
     *
     * @Route("/{id}", name="order_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();




        return array(
        );
    }
}
