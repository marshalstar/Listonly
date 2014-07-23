<?php

namespace User\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Base\Mail\Mail;

class User extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);

        $this->entity = "User\Entity\User";
    }

    public function insert(array $data) {
        if ($entity = parent::insert($data)) {
            return $entity;
        }
    }

    public function update(array $data) {
        if(empty($data['password'])) {
            unset($data['password']);
        }
        parent::update($data);
    }

}