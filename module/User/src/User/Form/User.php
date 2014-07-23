<?php

namespace User\Form;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject; // Hydrator
use Doctrine\ORM\EntityManager;
use Zend\Form\Form as ZendForm;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;
use Zend\Form\Element\Csrf;

class User extends ZendForm {

    /** @var EntityManager */
    private $em;

    public function __construct($em, $name = null, $options = array()) {
        parent::__construct('user', $options);

        $hydrator = new DoctrineObject($em, 'User\Entity\User');
        $this->setHydrator($hydrator);

        $this->setInputFilter(new UserFilter);
        $this->setAttribute('methos', 'post');

        $id = new Hidden('id');
        $this->add($id);

        $nome = new Text("name");
        $nome->setLabel("Nome: ")
            ->setAttribute("placeholder", "Entre com o nome");
        $this->add($nome);

        $nome = new Text("login");
        $nome->setLabel("Login: ")
            ->setAttribute("placeholder", "Entre com seu login");
        $this->add($nome);

        $email = new Text("email");
        $email->setLabel("Email: ")
            ->setAttribute("placeholder", "Entre com o email");
        $this->add($email);

        $password = new Password("password");
        $password->setLabel("Password: ")
            ->setAttribute("placeholder", "Entre com a senha");
        $this->add($password);

        $confirmation = new Password("confirmation");
        $confirmation->setLabel("Redigite: ")
            ->setAttribute("placeholder", "Redigite a senha");
        $this->add($confirmation);/**/

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