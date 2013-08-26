<?php

namespace Project\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjectMainBundle:Main:index.html.twig', array('name' => 'SUPERMOB'));
    }
}
