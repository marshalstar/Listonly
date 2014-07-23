<?php

namespace Alternative\Controller;

use Base\Controller\CrudController;

class AlternativesController extends CrudController {

    public function __construct() {
        $this->entity = 'Alternative\Entity\Alternative';
        $this->form = 'Alternative\Form\Alternative';
        $this->service = 'Alternative\Service\Alternative';
        $this->controller = 'alternative';
        $this->route = 'alternative-admin';
    }

} 