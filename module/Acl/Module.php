<?php

namespace Acl;

use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Acl\Form\Role' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $repo = $em->getRepository('Acl\Entity\Role');
                    $parent = $repo->fetchParent();

                    return new Form\Role('role', $parent);
                },
                'Acl\Form\Privilege' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $repoRoles = $em->getRepository('Acl\Entity\Role');
                    $roles = $repoRoles->fetchParent();

                    $repoResources = $em->getRepository('Acl\Entity\Resource');
                    $resources = $repoResources->fetchPairs();

                    return new Form\Privilege('privilege', $roles, $resources);
                },
                'Acl\Service\Role' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    return new Service\Role($em);
                },
                'Acl\Service\Resource' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    return new Service\Resource($em);
                },
                'Acl\Service\Privilege' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    return new Service\Privilege($em);
                },
                'Acl\Permissions\Acl' => function($sm) {
                        $em = $sm->get('Doctrine\ORM\EntityManager');

                        $repoRole = $em->getRepository('Acl\Entity\Role');
                        $roles = $repoRole->findAll();

                        $repoResource = $em->getRepository('Acl\Entity\Resource');
                        $resources = $repoResource->findAll();

                        $repoPrivilege = $em->getRepository('Acl\Entity\Privilege');
                        $privileges = $repoPrivilege->findAll();

                        return new Permissions\Acl($roles, $resources, $privileges);
                    },
            ),
        );
    }
        
}
