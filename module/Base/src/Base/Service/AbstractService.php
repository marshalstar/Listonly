<?php

namespace Base\Service;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Stdlib\Hydrator\ClassMethods;

abstract class AbstractService {
	
    /** @var EntityManager */
    protected $em;

    protected $entity;

    /** @var \Base\Service\DoctrineObject */
    protected $hydrator;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function insert($data) {
        $entity = $this->getHydrator()->hydrate($data, new $this->entity);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update($data) {
        $entity = $this->getHydrator()->hydrate($data, new $this->entity);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function delete($id) {
        $entity = $this->em->getReference($this->entity, $id);
        if($entity) {
            $this->em->remove($entity);
            $this->em->flush();
            return $id;
        }
    }

    /**
     * @param \Base\Service\DoctrineObject $hydrator
     * @return $this
     */
    public function setHydrator($hydrator) {
        $this->hydrator = $hydrator;
        return $this;
    }

    /** @return \Base\Service\DoctrineObject */
    public function getHydrator() {
        if($this->hydrator == null) {
            $this->hydrator = new DoctrineObject($this->em, $this->entity);
        }
        return $this->hydrator;
    }

}