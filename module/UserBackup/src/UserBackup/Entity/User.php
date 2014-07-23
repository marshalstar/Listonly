<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Math\Rand;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="User\Entity\UserRepository")
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=false)
     */
    private $activationKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    public function __construct(array $options = array()) {

        (new ClassMethods)->hydrate($options, $this);

        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");

        $this->salt = base64_encode(Rand::getBytes(8, true));
        $this->activationKey = md5($this->email.$this->salt);
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }
    
    /**
     * @param string $nome
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }
    
    /**
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }
    
    /**
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $this->encryptPassword($password);
        return $this;
    }

    public function encryptPassword($password) {
        return base64_encode(Pbkdf2::calc('sha256', $password, $this->salt, 10000, strlen($password)*2));
    }

    /**
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }
    
    /**
     * @param string $salt
     */
    public function setSalt($salt) {
        $this->salt = $salt;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getActive() {
        return $this->active;
    }
    
    /**
     * @param boolean $active
     */
    public function setActive($active) {
        $this->active = $active;
        return $this;
    }

    /**
     * @return string
     */
    public function getActivationKey() {
        return $this->activationKey;
    }
    
    /**
     * @param string $activationKey
     */
    public function setActivationKey($activationKey) {
        $this->activationKey = $activationKey;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }
    
    /**
     * @param \DateTime $updatedAt
     * @ORM\prePersist
     */
    public function setUpdatedAt($updatedAt = null) {
        $this->updatedAt = $updatedAt && $updatedAt instanceof \DateTime?
            $updatedAt : new \DateTime("now");
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt? $createdAt : new \DateTime("now");
        return $this;
    }
    
    public function toArray() {
        return (new ClassMethods())->extract($this);
    }

}