<?php

namespace Alternative\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Base\Mail\Mail;

class Alternative extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);

        $this->entity = 'Alternative\Entity\Alternative';
    }

}