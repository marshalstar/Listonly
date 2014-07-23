<?php

namespace Acl\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Acl\Entity\Role;

class LoadRole extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $visitante = new Role;
        $visitante->setNome("Visitante");
        $manager->persist($visitante);
        $manager->flush();
        
        $registrado = new Role;
        $registrado->setNome("Registrado")
                   ->setParent($visitante);
        $manager->persist($registrado);
        $manager->flush();
        
        $redator = new Role;
        $redator->setNome("Redator")
                ->setParent($registrado);
        $manager->persist($redator);
        $manager->flush();
        
        $admin = new Role;
        $admin->setNome("Admin")
              ->setIsAdmin(true);
        $manager->persist($admin);
        $manager->flush();
    }

    function getOrder() {
        return 1;
    }

}
