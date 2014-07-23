<?php

namespace Form\Controller;

use Base\Controller\CrudController;

class FormsController extends CrudController {

    public function __construct() {
        $this->entity = 'Form\Entity\Form';
        $this->form = 'Form\Form\Form';
        $this->service = 'Form\Service\Form';
        $this->controller = 'form';
        $this->route = 'form-admin';
    }

} 