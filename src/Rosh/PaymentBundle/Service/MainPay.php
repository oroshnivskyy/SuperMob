<?php

namespace Rosh\PaymentBundle\Service;

use Doctrine\Common\Persistence\ManagerRegistry;
use Rosh\PaymentBundle\Entity\PaymentOrder;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class MainPay{
    private $doctrine;
    private $templating;

    private $formParameters = array();
    private $templatePath;
    private $apiKey;

    public function __construct( ManagerRegistry $doctrine, EngineInterface $templating ){
        $this->doctrine = $doctrine;
        $this->templating = $templating;
    }

    public function setParameters( $url, $key, $image, $commission, $formMethod, $templatePath, $apiKey ){
        $this->formParameters[ 'url' ] = $url;
        $this->formParameters[ 'key' ] = $key;
        $this->formParameters[ 'image' ] = $image;
        $this->formParameters[ 'commission' ] = $commission;
        $this->formParameters[ 'formMethod' ] = $formMethod;
        $this->templatePath = $templatePath;
        $this->apiKey = $apiKey;
    }

    /**
     * Renders a form view.
     *
     * @return Response A Response instance
     */
    public function renderForm( $purchaseName, $email, $order ){
        $parameters = $this->formParameters;
        $parameters[ 'purchaseName' ] = $purchaseName;
        $parameters[ 'orderId' ] = $order->getId();
        $parameters[ 'cost' ] = $order->getPurchaseCost();
        $parameters[ 'defaultEmail' ] = $email;

        return $this->templating->renderResponse( $this->templatePath, $parameters );
    }

    public function processSuccess( Request $request ){
        $servicePostParameters = array(
            'tid' => null,
            'name' => null,
            'comment' => null,
            'partner_id' => null,
            'service_id' => null,
            'order_id' => null,
            'type' => null,
            'partner_income' => null,
            'system_income' => null,
            'test' => null );
        foreach($servicePostParameters as $name=>$value){
            $servicePostParameters[$name] = $request->get($name);
        }

        $check = md5(join('', array_values($servicePostParameters)).$this->apiKey);
        if($request->get( 'check' ) != $check){
            throw new \Exception("Check failed");
        }

        if($servicePostParameters['test']==1){
            return true;
        }

        /**
         * @var $order PaymentOrder
         */
        $order = $this->doctrine->getRepository('PaymentBundle:PaymentOrder')
            ->findOneById($servicePostParameters['order_id']);

        $order->setServiceTid($servicePostParameters['tid'])
            ->setServicePurchaseName($servicePostParameters['name'])
            ->setServiceComment($servicePostParameters['comment'])
            ->setServicePartnerId($servicePostParameters['partner_id'])
            ->setServiceId($servicePostParameters['service_id'])
            ->setServiceType($servicePostParameters['type'])
            ->setServicePartnerIncome($servicePostParameters['partner_income'])
            ->setServiceSystemIncome($servicePostParameters['system_income'])
            ->setStatus(PaymentOrder::STATUS_SUCCESS);

        $manager = $this->doctrine->getManager();
        $manager->persist($order);
        $manager->flush();
    }
}
 