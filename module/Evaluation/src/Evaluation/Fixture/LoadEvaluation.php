<?php

namespace Evaluation\Fixture;

use Answer\Entity\Answer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Evaluation\Entity\Evaluation;
use Form\Entity\Form;
use User\Entity\User;

class LoadEvaluation extends AbstractFixture {

	public function load(ObjectManager $manager) {

        $user = new User();
        $user->setName('relation-evaluation');
        $manager->persist($user);

        $form = new Form();
        $form->setName('relation-evaluation');
        $manager->persist($form);

        $answer = new Answer();
        $manager->persist($answer);

        $evaluation = new Evaluation();
        $evaluation->setUser($user);
        $evaluation->setForm($form);
        $manager->persist($evaluation);

        $evaluation->addAnswer($answer);

        $manager->flush();
	}

}