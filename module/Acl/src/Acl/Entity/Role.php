<?php

namespace Acl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="Acl\Entity\RoleRepository")
 */
class Role {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Acl\Entity\Role")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $nome;
    
    /**
     * @ORM\Column(type="boolean", name="is_admin")
     */
    protected $isAdmin;
    
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
    
    public function getParent() {
        return $this->parent;
    }

    public function setParent($parent) {
        $this->parent = $parent;
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
    }

    public function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
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
     * @ORM\prePersist
     */
    public function setUpdatedAt($updatedAt) {
        if($updatedAt instanceOf \DateTime) {
            $this->updatedAt = $updatedAt;
        } else {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    public function __toString() {
        return $this->nome;
    }
    
    public function toArray() {
        
        $parent = isset($this->parent)? $parent = $this->parent->getId() : false;
        
        $array = array(
            'id' => $this->id,
            'nome' => $this->nome,
            'isAdmin' => $this->isAdmin,
            'parent' => $parent,
        );

        return $array;
    }
    
}
