<?php

namespace Alternative\Form;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject; // Hydrator
use Doctrine\ORM\EntityManager;
use Zend\Form\Form as ZendForm;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;
use Zend\Form\Element\Csrf;

class Alternative extends ZendForm {

    /** @var EntityManager */
    private $em;

    public function __construct($em, $name = null, $options = array()) {
        parent::__construct('alternative', $options);

        $hydrator = new DoctrineObject($em, 'Alternative\Entity\Alternative');
        $this->setHydrator($hydrator);

        $this->setInputFilter(new AlternativeFilter);
        $this->setAttribute('methos', 'post');

        $id = new Hidden('id');
        $this->add($id);

        $text = new Text("type");
        $text->setLabel("Tipo: ")
            ->setAttribute("placeholder", "Entre com o tipo");
        $this->add($text);

        $text = new Text("text");
        $text->setLabel("Texto: ")
             ->setAttribute("placeholder", "Entre com o texto");
        $this->add($text);

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