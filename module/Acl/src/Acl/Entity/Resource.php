<?php

namespace Acl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="resources")
 * @ORM\Entity(repositoryClass="Acl\Entity\ResourceRepository")
 */
class Resource {


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $nome;
    
    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;
    
    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;
    
    public function __construct(array $options = array()) {
        (new ClassMethods)->hydrate($options, $this);
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        if($createdAt instanceOf \DateTime) {
            $this->createdAt = $createdAt;
        } else {
            $this->createdAt = new \DateTime('now');
        }
        return $this;
    }
    
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt($updatedAt) {
        if($updatedAt instanceOf \DateTime) {
            $this->updatedAt = $updatedAt;
        } else {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }
    
    public function toArray() {
        return (new ClassMethods)->extract($this);
    }
    
}
