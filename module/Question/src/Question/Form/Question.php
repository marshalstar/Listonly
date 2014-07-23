<?php

namespace Question\Form;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Form as ZendForm; // Hydrator

class Question extends ZendForm {

    public function __construct($em, $name = null, $options = array()) {
        parent::__construct('question', $options);

        $hydrator = new DoctrineObject($em, 'Question\Entity\Question');
        $this->setHydrator($hydrator);

        $this->setInputFilter(new QuestionFilter);
        $this->setAttribute('method', 'post');

        $id = new Hidden('id');
        $this->add($id);

        $text = new Text("text");
        $text->setLabel("Nome: ")
            ->setAttribute("placeholder", "Entre com o texto");
        $this->add($text);

        $this->add(array(
            'name' => 'title',
            'type' => '\DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Título',
                'empty_option'    => 'Selecionar Título',
                'object_manager' => $em,
                'target_class' => '\Title\Entity\Title',
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