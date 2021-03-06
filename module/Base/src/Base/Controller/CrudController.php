<?php

namespace Base\Controller;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

abstract class CrudController extends AbstractActionController {
    
    /** @var \Doctrine\ORM\EntityManager */
    protected $em;
    protected $service;
    protected $entity;
    protected $form;
    protected $route;
    protected $controller;
    
    public function indexAction() {

        $list = $this->getEm()
                     ->getRepository($this->entity)
                     ->findAll();

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
                  ->setDefaultItemCountPerPage(10);
         
         return new ViewModel(array(
             'paginator' => $paginator,
         ));
    }

    public function newAction() {
        $form = new $this->form($this->getEm());
        $request = $this->getRequest();
        
        if($request->isPost()) {
            $form->setData($request->getPost());


            if($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->insert($request->getPost()->toArray());
                
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        
        return new ViewModel(array(
            'form' => $form,
        ));
    }
    
    public function editAction() {
        $form = new $this->form($this->getEm());
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $id = $this->params()->fromRoute('id', 0);
        $entity = $repository->find($id);

        if($id) {
            $form->bind($entity);
        }

        if($request->isPost()) {
            $form->setData($request->getPost());
            
            if($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());
                
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        
        return new ViewModel(array(
            'form' => $form,
        ));
    }
    
    public function deleteAction() {
        $service = $this->getServiceLocator()->get($this->service);
        if($service->delete($this->params()->fromRoute('id', 0))) {
            return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
        }
    }
    
    /** @return \Doctrine\ORM\EntityManager */
    protected function getEm() {
        if($this->em === null) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }
    
}
