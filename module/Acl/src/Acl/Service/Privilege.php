<?php

namespace Acl\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator\ClassMethods;

class Privilege extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = "Acl\Entity\Privilege";
    }

    public function insert(array $data) {


        $entity = new $this->entity($data);

        $role = $this->em->getReference('Acl\Entity\Role', $data['role']);
        $entity->setRole($role);

        $resource = $this->em->getReference('Acl\Entity\Resource', $data['resource']);
        $entity->setResource($resource);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update(array $data) {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new ClassMethods)->hydrate($data, $entity);

        $role = $this->em->getReference('Acl\Entity\Role', $data['role']);
        $entity->setRole($role);

        $resource = $this->em->getReference('Acl\Entity\Resource', $data['resource']);
        $entity->setResource($resource);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

}