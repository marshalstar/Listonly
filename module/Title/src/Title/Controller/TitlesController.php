<?php

namespace Title\Controller;

use Base\Controller\CrudController;

class TitlesController extends CrudController {

    public function __construct() {
        $this->entity = 'Title\Entity\Title';
        $this->form = 'Title\Form\Title';
        $this->service = 'Title\Service\Title';
        $this->controller = 'titles';
        $this->route = 'title-admin';
    }

} 