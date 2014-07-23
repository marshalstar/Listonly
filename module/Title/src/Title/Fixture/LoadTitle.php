<?php

namespace Title\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Question\Entity\Question;
use Title\Entity\Title;

class LoadTitle extends AbstractFixture {

	public function load(ObjectManager $manager) {

        $question = new Question();
        $question->setText('relation-title');
        $manager->persist($question);

        $title = new Title();
        $title->setName("title");
        $title->setCalculation("calculation");
        $manager->persist($title);

        $title->addQuestion($question);

        $manager->flush();
	}

}