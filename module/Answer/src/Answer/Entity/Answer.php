<?php

namespace Answer\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbAnswer")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Answer\Entity\AnswerRepository")
 */
class Answer extends AbstractEntity {

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Question\Entity\Question")
     * @ORM\JoinColumn(name="tbQuestion_id", referencedColumnName="id")
     */
    protected $question;

    /**
     * @ORM\ManyToOne(targetEntity="Evaluation\Entity\Evaluation", inversedBy="enswers")
     * @ORM\JoinColumn(name="tbEvaluation_id", referencedColumnName="id")
     */
    protected $evaluation;

    /**
     * @ORM\ManyToOne(targetEntity="Alternative\Entity\Alternative")
     * @ORM\JoinColumn(name="tbAlternative_id", referencedColumnName="id")
     */
    protected $alternative;

    public function __construct(array $options = array()) {
        (new ClassMethods)->hydrate($options, $this);
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $evaluation
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;
    }

    /**
     * @return mixed
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * @param mixed $alternative
     */
    public function setAlternative($alternative)
    {
        $this->alternative = $alternative;
    }

    /**
     * @return mixed
     */
    public function getAlternative()
    {
        return $this->alternative;
    }


}