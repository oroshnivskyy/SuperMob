<?php

namespace Rosh\PaymentBundle\Controller;

use Rosh\PaymentBundle\Entity\PaymentOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{

    public function renderAction($paymentService, $purchase, $email=null)
    {
        $order = new PaymentOrder();
        $order->setEmail($email);
        $order->setPurchase($purchase);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($order);
        $manager->flush();
        $paymentService = $this->get('payment.'. $paymentService);

        return $paymentService->renderForm($purchase->getName(), $email, $order );
    }


    public function processorAction($paymentService){
        $paymentService = $this->get('payment.'. $paymentService);
        $paymentService->processSuccess($this->getRequest());

        return new Response('Success');
    }

    public function successAction($paymentService){

    }

    public function failAction($paymentService){

    }
}
