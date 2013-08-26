<?php

namespace Application\Project\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:Main:index.html.twig', array('name' => 'SUPERMOB'));
    }
}
