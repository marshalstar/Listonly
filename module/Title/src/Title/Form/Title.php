<?php

namespace Title\Form;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Form as ZendForm; // Hydrator

class Title extends ZendForm {

    /** @var EntityManager */
    private $em;

    public function __construct($em, $name = null, $options = array()) {
        parent::__construct('title', $options);

        $hydrator = new DoctrineObject($em, 'Title\Entity\Title');
        $this->setHydrator($hydrator);

        $this->setInputFilter(new TitleFilter);
        $this->setAttribute('methos', 'post');

        $id = new Hidden('id');
        $this->add($id);

        $nome = new Text("name");
        $nome->setLabel("Nome: ")
            ->setAttribute("placeholder", "Entre com o nome");
        $this->add($nome);

        $nome = new Text("calculation");
        $nome->setLabel("Calculo: ")
            ->setAttribute("placeholder", "Entre com o calculo");
        $this->add($nome);

        /*$this->add(array(
            'name' => 'questions',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Questões',
                'empty_option'    => 'Selecionar Questões',
                'object_manager' => $em,
                'target_class' => '\Question\Entity\Question',
                'property' => 'text'
            ),
            'attributes' => array(
                'multiple' => 'multiple',
                'required' => false,
                'class' => 'chosen'
            )
        ));/**/

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