<?php

namespace User\Controller;

use Base\Controller\CrudController;
use User\Entity\User;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

class UsersController extends CrudController {

    public function __construct() {
        $this->entity = 'User\Entity\User';
        $this->form = '\User\Form\User';
        $this->service = 'User\Service\User';
        $this->controller = 'user';
        $this->route = 'user-admin';
    }
} 