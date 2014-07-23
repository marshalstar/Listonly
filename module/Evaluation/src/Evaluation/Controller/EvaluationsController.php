<?php

namespace Evaluation\Controller;

use Base\Controller\CrudController;

class EvaluationsController extends CrudController {

    public function __construct() {
        $this->entity = 'Evaluation\Entity\Evaluation';
        $this->form = 'Evaluation\Form\Evaluation';
        $this->service = 'Evaluation\Service\Evaluation';
        $this->controller = 'evaluation';
        $this->route = 'evaluation-admin';
    }

} 