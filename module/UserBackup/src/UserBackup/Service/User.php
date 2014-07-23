<?php

namespace User\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Base\Mail\Mail;

class User extends AbstractService {
	
    /**
     * @var SmtpTransport
     */
    protected $transport;

    /**
     * @var ViewModel
     */
    protected $view;

    public function __construct(EntityManager $em, SmtpTransport $transport, $view) {
        parent::__construct($em);

        $this->entity = "User\Entity\User";
        $this->transport = $transport;
        $this->view = $view;
    }

    public function insert(array $data) {
        $entity = parent::insert($data);

        $dataEmail = array('nome' => $data['nome'], 'activationKey' => $entity->getActivationKey());

        if($entity) {

            /*new Mail($this->transport, $this->view, 'add-user');
            $mail = new Mail($this->transport, $this->view, 'add-user');
            $mail->setSubject("Confirmação de cadastro")
                     ->setTo($data['email'])
                     ->setData($dataEmail)
                     ->prepare()
                     ->send();/**/
            return $entity;
        }
    }

    public function activate($key) {

        $repo = $this->em->getRepository("User\Entity\User");

        $user = $repo->findOneByActivationKey($key);

        if($user && !$user->getActive()) {
            $user->setActive(true);

            $this->em->persist($user);
            $this->em->flush();

            return $user;
        }
    }

    public function update(array $data) {
        if(empty($data['password'])) {
            unset($data['password']);
        }
        parent::update($data);
    }

}