<?php

namespace Base\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;

class AbstractEntity {

    public function __construct(array $options = array()) {
        (new ClassMethods)->hydrate($options, $this);
    }

    public function toArray() {
        return (new ClassMethods())->extract($this);
    }

    public function __call($method, $parameters) {

        $pre  = substr($method, 0, 3);
        $var = lcfirst(substr($method, 3));

        if ($pre == 'set') {
            $this->$var = $parameters[0];
        } elseif ($pre  == 'get') {
            return $this->$var;
        }
    }

} 