<?php

namespace Form\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class Form extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'Form\Entity\Form';
    }

}