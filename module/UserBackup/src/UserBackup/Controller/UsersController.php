<?php

namespace User\Controller;

use Zend\View\Model\ViewModel;

class UsersController extends CrudController {
    
    public function __construct() {
        $this->entity = 'User\Entity\User';
        $this->form = 'User\Form\User';
        $this->service = 'User\Service\User';
        $this->controller = 'user';
        $this->route = 'user-admin';
    }
    
    public function editAction() {
        
        $form = new $this->form();
        $request = $this->getRequest();
        
        $repository = $this->getEm()->getRepository($this->entity);
        $id = $this->params()->fromRoute('id', 0);
        $entity = $repository->find($id);
        
        if($id) {
            $array = $entity->toArray();
            unset($array['password']);
            $form->setData($array);
        }
        
        if($request->isPost()) {
            $form->setData($request->getPost());
            
            if($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());
                
                return $this->redirect()->toRoute($this->route, array('controller' => 'users', 'action' => 'index'));
            }
        }
        
        return new ViewModel(array(
            'form' => $form,
        ));
        
    }
    
}
