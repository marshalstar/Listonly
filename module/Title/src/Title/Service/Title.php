<?php

namespace Title\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class Title extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'Title\Entity\Title';
    }

}