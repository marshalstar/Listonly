<?php

namespace Answer\Form;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject; // Hydrator
use Doctrine\ORM\EntityManager;
use Zend\Form\Form as ZendForm;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;
use Zend\Form\Element\Csrf;

class Answer extends ZendForm {

    /** @var EntityManager */
    private $em;

    public function __construct($em, $name = null, $options = array()) {
        parent::__construct('answer', $options);

        $hydrator = new DoctrineObject($em, 'Answer\Entity\Answer');
        $this->setHydrator($hydrator);

        $this->setInputFilter(new AnswerFilter);
        $this->setAttribute('methos', 'post');

        $id = new Hidden('id');
        $this->add($id);

        $this->add(array(
            'name' => 'evaluation',
            'type' => '\DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Avaliação',
                'empty_option'    => 'Selecionar avaliação',
                'object_manager' => $em,
                'target_class' => '\Evaluation\Entity\Evaluation',
                'property' => 'id'
            ),
            'attributes' => array(
                //'multiple' => 'multiple',
                'required' => false,
                'class' => 'chosen'
            )
        ));

        $this->add(array(
            'name' => 'question',
            'type' => '\DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Questão',
                'empty_option'    => 'Selecionar Questão',
                'object_manager' => $em,
                'target_class' => '\Question\Entity\Question',
                'property' => 'text'
            ),
            'attributes' => array(
                //'multiple' => 'multiple',
                'required' => false,
                'class' => 'chosen'
            )
        ));

        $this->add(array(
            'name' => 'alternative',
            'type' => '\DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Alternativa',
                'empty_option'    => 'Selecionar alternativa',
                'object_manager' => $em,
                'target_class' => '\Alternative\Entity\Alternative',
                'property' => 'text'
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