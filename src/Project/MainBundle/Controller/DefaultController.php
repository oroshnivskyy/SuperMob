<?php

namespace Project\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProjectMainBundle:Default:index.html.twig', array('name' => $name));
    }
}
