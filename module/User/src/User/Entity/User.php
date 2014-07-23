<?php

namespace User\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbUser")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="User\Entity\UserRepository")
 */
class User extends AbstractEntity {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     */
    protected $password;

    /**
     * @ORM\Column(name="role", type="string", length=255)
     */
    protected $role;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(name="login", type="string", length=255)
     */
    protected $login;

    /**
     * @ORM\Column(name="email", type="string", length=255)
     */
    protected $email;

    /**
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    protected $updatedAt;

    /**
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Form\Entity\Form", mappedBy="user")
     */
    protected $forms;

    /**
     * @ORM\OneToMany(targetEntity="Evaluation\Entity\Evaluation", mappedBy="user")
     */
    protected $evaluations;

    public function __construct(array $options = array()) {
        (new ClassMethods)->hydrate($options, $this);
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
        $this->forms = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
    }

    /** @param int $id */
    public function setId($id) {
        $this->id = $id;
    }

    /** @return int */
    public function getId() {
        return $this->id;
    }

    /** @param mixed $password */
    public function setPassword($password) {
        $this->password = $password;
    }

    /** @return mixed */
    public function getPassword() {
        return $this->password;
    }

    /** @param mixed $role */
    public function setRole($role) {
        $this->role = $role;
    }

    /** @return mixed */
    public function getRole() {
        return $this->role;
    }

    /** @param mixed $name */
    public function setName($name) {
        $this->name = $name;
    }

    /** @return mixed */
    public function getName() {
        return $this->name;
    }

    /** @param mixed $login */
    public function setLogin($login) {
        $this->login = $login;
    }

    /** @return mixed */
    public function getLogin() {
        return $this->login;
    }

    /** @param mixed $email */
    public function setEmail($email) {
        $this->email = $email;
    }

    /** @return mixed */
    public function getEmail() {
        return $this->email;
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

    /** @param mixed $forms */
    public function setForms($forms) {
        $this->forms = $forms;
    }

    /** @return mixed */
    public function getForms() {
        return $this->forms;
    }

    /** @param mixed $evaluations */
    public function setEvaluations($evaluations) {
        $this->evaluations = $evaluations;
    }

    /** @return mixed */
    public function getEvaluations() {
        return $this->evaluations;
    }

    public function addForm($form) {
        $this->forms->add($form);
        $form->setUser($this);
    }

    public function addEvaluation($evaluation) {
        $this->evaluations->add($evaluation);
        $evaluation->setUser($this);
    }

}