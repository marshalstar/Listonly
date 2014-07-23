<?php

namespace Form\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbForm")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Form\Entity\FormRepository")
 */
class Form extends AbstractEntity {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    protected $updatedAt;

    /**
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User\Entity\User", inversedBy="forms")
     * @ORM\JoinColumn(name="tbUser_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="Title\Entity\Title", mappedBy="forms")
     * @ORM\JoinTable(name="tbForm_has_tbTitle",
     *      joinColumns={@ORM\JoinColumn(name="tbTitle_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tbForm_id", referencedColumnName="id")}
     * )
     */
    protected $titles;

    public function __construct(array $options = array()) {
        (new ClassMethods)->hydrate($options, $this);
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
        $this->titles = new ArrayCollection();
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
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $titles
     */
    public function setTitles($titles)
    {
        $this->titles = $titles;
    }

    /**
     * @return mixed
     */
    public function getTitles()
    {
        return $this->titles;
    }

    public function addTitle($title) {
        $this->titles->add($title);
        $title->getForms()->add($this);
    }

}