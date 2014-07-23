<?php

namespace Question\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbQuestion")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Question\Entity\QuestionRepository")
 */
class Question extends AbstractEntity {

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

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
     * @ORM\ManyToOne(targetEntity="Title\Entity\Title", inversedBy="questions")
     * @ORM\JoinColumn(name="tbTitle_id", referencedColumnName="id")
     */
    protected $title;

    /**
     * @ORM\ManyToMany(targetEntity="Alternative\Entity\Alternative", inversedBy="questions")
     * @ORM\JoinTable(name="tbAlternative_has_tbQuestion",
     *      joinColumns={@ORM\JoinColumn(name="tbQuestion_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tbAlternative_id", referencedColumnName="id")}
     * )
     */
    protected $alternatives;

    public function __construct(array $options = array()) {
        (new ClassMethods)->hydrate($options, $this);
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
        $this->alternatives = new ArrayCollection();
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
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $alternatives
     */
    public function setAlternatives($alternatives)
    {
        $this->alternatives = $alternatives;
    }

    /**
     * @return mixed
     */
    public function getAlternatives()
    {
        return $this->alternatives;
    }

    public function addAlternative($alternative) {
        $this->alternatives->add($alternative);
        $alternative->getQuestions()->add($this);
    }

}