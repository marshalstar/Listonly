<?php

namespace Title\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbTitle")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Title\Entity\TitleRepository")
 */
class Title extends AbstractEntity {

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(name="calculation", type="string", length=255)
     */
    protected $calculation;

    /**
     * @ORM\Column(name="updatedAt", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Question\Entity\Question", mappedBy="title")
     */
    protected $questions;

    /**
     * @ORM\ManyToMany(targetEntity="Form\Entity\Form", inversedBy="titles")
     * @ORM\JoinTable(name="tbForm_has_tbTitle",
     *      joinColumns={@ORM\JoinColumn(name="tbTitle_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tbForm_id", referencedColumnName="id")}
     * )
     */
    protected $forms;


    public function __construct(array $options = array()) {
        (new ClassMethods)->hydrate($options, $this);
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
        $this->questions = new ArrayCollection();
        $this->forms = new ArrayCollection();
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
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $calculation
     */
    public function setCalculation($calculation)
    {
        $this->calculation = $calculation;
    }

    /**
     * @return mixed
     */
    public function getCalculation()
    {
        return $this->calculation;
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

    /**
     * @param mixed $forms
     */
    public function setForms($forms)
    {
        $this->forms = $forms;
    }

    /**
     * @return mixed
     */
    public function getForms()
    {
        return $this->forms;
    }

    public function addQuestion($question) {
        $this->questions->add($question);
        $question->setTitle($this);
    }

    public function addForm($form) {
        $this->forms->add($form);
        $form->getTitles()->add($this);
    }

}