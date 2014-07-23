<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use User\Form\Login as LoginForm;

class AuthController extends AbstractActionController {
    
    public function __construct() {
        ;
    }
    
    public function indexAction() {

        $form = new LoginForm;
        $request = $this->getRequest();
        $error = false;

        if($request->isPost()) {
            $form->setData($request->getPost());

            if($form->isValid()) {
                $data = $request->getPost()->toArray();

                $sessionStorage = new SessionStorage('User');
                $auth = new AuthenticationService;
                $auth->setStorage($sessionStorage);

                $authAdapter = $this->getServiceLocator()->get('User\Auth\Adapter');
                $authAdapter->setUsername($data['email']);
                $authAdapter->setPassword($data['password']);

                $result = $auth->authenticate($authAdapter);
                //\Kint::dump($result->isValid()); die("MORRE MORRE MORRE");

                if($result->isValid()) {
                    $sessionStorage->write($auth->getIdentity()['user'], null);
                    return $this->redirect()->toRoute('user-admin/default', array('controller' => 'users'));   
                }
                
                $error = true;
            }
        }
        return new ViewModel(array('form' => $form, 'error' => $error));
    }
    
    public function logoutAction() {
        
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage('User'));
        $auth->clearIdentity();
        
        return $this->redirect()->toRoute('user-auth');
    }
    
}
