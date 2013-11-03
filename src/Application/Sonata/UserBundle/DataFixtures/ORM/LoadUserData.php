<?php

namespace Application\Sonata\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Sonata\UserBundle\Entity\User;
use Application\Project\MainBundle\Entity\Operator;
use Application\Project\MainBundle\Entity\OperatorCode;

class LoadUserData implements FixtureInterface{
    public function load(ObjectManager $manager)
    {
        $operatorKievStart = new Operator();
        $operatorKievStart->setName('КиевСтарт');
        $operatorKievStart->setUrl('http://www.kyivstar.ua');
        $operatorKievStart->setStatus(true);
        $operatorKievStart->setCountry(1);

        $operatorMts = new Operator();
        $operatorMts->setName('МТС');
        $operatorMts->setUrl('http://www.mts.com.ua');
        $operatorMts->setStatus(true);
        $operatorMts->setCountry(1);

        $manager->persist($operatorKievStart);
        $manager->persist($operatorMts);
        $manager->flush();

        $operatorCode1 = new OperatorCode();
        $operatorCode1->setCode('067');
        $operatorCode1->setStatus(1);
        $operatorCode1->setOperator($operatorKievStart);

        $operatorCode2 = new OperatorCode();
        $operatorCode2->setCode('050');
        $operatorCode2->setStatus(1);
        $operatorCode2->setOperator($operatorMts);

        $manager->persist($operatorCode1);
        $manager->persist($operatorCode2);
        $manager->flush();

        $userRosh = new User();
        $userRosh->setUsername('rosh');
        $userRosh->setPlainPassword(123);
        $userRosh->setEnabled(true);
        $userRosh->setRoles(array('ROLE_ADMIN'));
        $userRosh->setEmail('rosh@gmail.com');
        $userRosh->setOperator($operatorKievStart);
        $userRosh->setCountry(1);

        $userCokc = new User();
        $userCokc->setUsername('kokcito');
        $userCokc->setPlainPassword(123);
        $userCokc->setEnabled(true);
        $userCokc->setRoles(array('ROLE_ADMIN'));
        $userCokc->setEmail('kokcito@gmail.com');
        $userCokc->setOperator($operatorMts);
        $userCokc->setCountry(1);

        $manager->persist($userRosh);
        $manager->persist($userCokc);
        $manager->flush();
    }
}
 