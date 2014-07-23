<?php

namespace Question\Fixture;

use Alternative\Entity\Alternative;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Question\Entity\Question;
use Title\Entity\Title;

class LoadQuestion extends AbstractFixture {

	public function load(ObjectManager $manager) {

        $alternative = new Alternative();
        $alternative->setText('relation-n-n-alternative');
        $manager->persist($alternative);

        $title = new Title();
        $title->setName("relation-question");
        $manager->persist($title);

        $question = new Question();
        $question->setText("text");
        $question->setTitle($title);
        $manager->persist($question);

        $question->addAlternative($alternative);

        $manager->flush();
	}

}