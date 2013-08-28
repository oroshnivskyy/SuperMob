<?php

namespace Application\Sonata\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Sonata\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface{
    public function load(ObjectManager $manager)
    {
        $userRosh = new User();
        $userRosh->setUsername('rosh');
        $userRosh->setPlainPassword(123);
        $userRosh->setEnabled(true);
        $userRosh->setRoles(array('ROLE_ADMIN'));
        $userRosh->setEmail('rosh@gmail.com');

        $userCokc = new User();
        $userCokc->setUsername('kokcito');
        $userCokc->setPlainPassword(123);
        $userCokc->setEnabled(true);
        $userCokc->setRoles(array('ROLE_ADMIN'));
        $userCokc->setEmail('kokcito@gmail.com');

        $manager->persist($userRosh);
        $manager->persist($userCokc);
        $manager->flush();
    }
}
 