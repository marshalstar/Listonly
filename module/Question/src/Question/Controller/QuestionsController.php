<?php

namespace Question\Controller;

use Base\Controller\CrudController;

class QuestionsController extends CrudController {

    public function __construct() {
        $this->entity = 'Question\Entity\Question';
        $this->form = 'Question\Form\Question';
        $this->service = 'Question\Service\Question';
        $this->controller = 'question';
        $this->route = 'question-admin';
    }

} 