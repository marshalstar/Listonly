<?php

namespace Form\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Form\Entity\Form;
use Title\Entity\Title;
use User\Entity\User;

class LoadForm extends AbstractFixture {

	public function load(ObjectManager $manager) {

        $user = new User();
        $user->setName('relation-form');
        $manager->persist($user);

        $title = new Title();
        $title->setName('relation-n-n-form');
        $manager->persist($title);

        $form = new Form();
        $form->setName("name");
        $form->setUser($user);
        $manager->persist($form);

        $form->addTitle($title);

        $manager->flush();
	}

}