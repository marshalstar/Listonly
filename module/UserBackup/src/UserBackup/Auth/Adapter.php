<?php

namespace User\Auth;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface {
    
    protected $em;
    protected $password;
    protected $username;
    
    public function __construct($em) {
        $this->em = $em;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    } 
    
    public function authenticate() {
        $repository = $this->em->getRepository('User\Entity\User');
        $user = $repository->findByEmailAndPassword($this->getUsername(), $this->getPassword());
        
        if($user) {
            return new Result(Result::SUCCESS, array('user' => $user), array("OK"));
        }
        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array());
        
    }

}
