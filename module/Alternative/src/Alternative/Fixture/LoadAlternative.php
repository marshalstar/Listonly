<?php

namespace Alternative\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Alternative\Entity\Alternative;

class LoadAlternative extends AbstractFixture {

	public function load(ObjectManager $manager) {

        $alternative = new Alternative();
        $alternative->setType("type");
        $alternative->setText("text");
        $manager->persist($alternative);

        $manager->flush();
	}

}