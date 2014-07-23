<?php

namespace Evaluation\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Base\Mail\Mail;

class Evaluation extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);

        $this->entity = 'Evaluation\Entity\Evaluation';
    }

}