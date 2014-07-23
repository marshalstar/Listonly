<?php

namespace Answer\Fixture;

use Alternative\Entity\Alternative;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Answer\Entity\Answer;
use Evaluation\Entity\Evaluation;
use Question\Entity\Question;

class LoadAnswer extends AbstractFixture {

	public function load(ObjectManager $manager) {

        $question = new Question();
        $question->setText('relation-answer');
        $manager->persist($question);

        $evaluation = new Evaluation();
        $manager->persist($evaluation);

        $alternative = new Alternative();
        $alternative->setText('relation-answer');
        $manager->persist($alternative);

        $answer = new Answer();
        $answer->setName("answer");
        $answer->setQuestion($question);
        $answer->setEvaluation($evaluation);
        $answer->setAlternative($alternative);
        $manager->persist($answer);

        $manager->flush();
	}

}