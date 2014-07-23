<?php

namespace User\View\Helper;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\View\Helper\AbstractHelper;

class UserIdentity extends AbstractHelper {
    
    protected $authService;
    
    public function getAuthService() {
        return $this->authService;
    }
    
    public function __invoke($namespace = null) {
        
        $sessionStorage = new SessionStorage($namespace);
        $this->authService = new AuthenticationService;
        //\Kint::dump([$sessionStorage, $this->authService]);
        $this->authService->setStorage($sessionStorage);
        
        if($this->getAuthService()->hasIdentity()) {
            return $this->getAuthService()->getIdentity();
        }
        return false;
    }
    
}
