<?php

namespace Form\Form;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Form as ZendForm; // Hydrator

class Form extends ZendForm {

    /** @var EntityManager */
    private $em;

    public function __construct($em, $name = null, $options = array()) {
        parent::__construct('form', $options);

        $hydrator = new DoctrineObject($em, 'Form\Entity\Form');
        $this->setHydrator($hydrator);

        $this->setInputFilter(new FormFilter);
        $this->setAttribute('method', 'post');

        $id = new Hidden('id');
        $this->add($id);

        $nome = new Text("name");
        $nome->setLabel("Nome: ")
            ->setAttribute("placeholder", "Entre com o nome");
        $this->add($nome);

        $this->add(array(
            'name' => 'user',
            'type' => '\DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Usuário',
                'empty_option'    => 'Selecionar Usuário',
                'object_manager' => $em,
                'target_class' => '\User\Entity\User',
                'property' => 'name'
            ),
            'attributes' => array(
                //'multiple' => 'multiple',
                'required' => false,
                'class' => 'chosen'
            )
        ));

        $csrf = new Csrf("security");
        $this->add($csrf);/**/

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn-success',
            ),
        ));
    }

} 