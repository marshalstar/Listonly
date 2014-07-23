<?php

namespace User\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Evaluation\Entity\Evaluation;
use Form\Entity\Form;
use User\Entity\User;

class LoadUser extends AbstractFixture {

	public function load(ObjectManager $manager) {

        $user = new User();
        $user->setPassword("password");
        $user->setRole("role");
        $user->setName("name");
        $user->setLogin("login");
        $user->setEmail("email");
        $manager->persist($user);

        $form = new Form();
        $form->setName('relation-user');
        $manager->persist($form);

        $user->addForm($form);

        $evaluation = new Evaluation();
        $manager->persist($evaluation);

        $user->addEvaluation($evaluation);

        $manager->flush();

	}

}