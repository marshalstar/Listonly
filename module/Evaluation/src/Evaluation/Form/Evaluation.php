<?php

namespace Evaluation\Form;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject; // Hydrator
use Doctrine\ORM\EntityManager;
use Zend\Form\Form as ZendForm;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;
use Zend\Form\Element\Csrf;

class Evaluation extends ZendForm {

    /** @var EntityManager */
    private $em;

    public function __construct($em, $name = null, $options = array()) {
        parent::__construct('Evaluation', $options);

        $hydrator = new DoctrineObject($em, 'Evaluation\Entity\Evaluation');
        $this->setHydrator($hydrator);

        //$this->setInputFilter(new EvaluationFilter);
        $this->setAttribute('methos', 'post');

        $id = new Hidden('id');
        $this->add($id);

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

        $this->add(array(
            'name' => 'form',
            'type' => '\DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Formulário',
                'empty_option'    => 'Selecionar Formulário',
                'object_manager' => $em,
                'target_class' => '\Form\Entity\Form',
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