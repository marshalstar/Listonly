<?php

namespace User\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use User\Entity\User;

/**
 * commandos: php vendor/doctrine/doctrine-module/bin/doctrine-module data-fixture:import --purge-with-truncate
 */
class LoadUser extends AbstractFixture {

	public function load(ObjectManager $manager) {

		for($i = 1; $i <= 100; ++$i) {
			$user = new User();
			$user->setNome("user$i")
				 ->setEmail("email$i@server.com")
				 ->setPassword("$i")
				 ->setActive(true);
			$manager->persist($user);
		}

		$manager->flush();
	}

}