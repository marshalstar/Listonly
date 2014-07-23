<?php

namespace Answer\Controller;

use Base\Controller\CrudController;

class AnswersController extends CrudController {

    public function __construct() {
        $this->entity = 'Answer\Entity\Answer';
        $this->form = 'Answer\Form\Answer';
        $this->service = 'Answer\Service\Answer';
        $this->controller = 'answer';
        $this->route = 'answer-admin';
    }

} 