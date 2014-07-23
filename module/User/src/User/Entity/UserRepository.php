<?php

namespace User\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {

    public function findByEmailAndPassword($email, $password) {

        $user = $this->findOneBy(['email' => $email]);

        if($user && $user->getPassword() == $password) {
            return $user;
            /*$hashSenha = $user->encryptPassword($password);
            if($hashSenha == $user->getPassword()) {
                return $user;
            }*/
        }
        return false;
    }

}
