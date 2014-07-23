<?php

namespace Alternative\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbAlternative")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Alternative\Entity\AlternativeRepository")
 */
class Alternative extends AbstractEntity {

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(name="type", type="string", length=255)
     */
    protected $type;

    /**
     * @ORM\Column(name="text", type="string", length=255)
     */
    protected $text;

    /**
     * @ORM\Column(name="updatedAt", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="Question\Entity\Question", mappedBy="alternatives")
     * @ORM\JoinTable(name="tbAlternative_has_tbQuestion",
     *      joinColumns={@ORM\JoinColumn(name="tbQuestion_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tbAlternative_idtbQuestion_id", referencedColumnName="id")}
     * )
     */
    protected $questions;

    public function __construct(array $options = array()) {
        (new ClassMethods)->hydrate($options, $this);
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
        $this->questions = new ArrayCollection();
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
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @ORM\prePersist
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = new \DateTime("now");
    }

    /** @return mixed */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     *
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = new \DateTime("now");
    }

    /** @return mixed */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * @param mixed $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    /**
     * @return mixed
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    public function addQuestion($question) {
        $this->questions->add($question);
        $question->getAlternatives()->add($this);
    }

}