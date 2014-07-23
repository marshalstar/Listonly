<?php

namespace User\Form;

use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter {
	
	public function __construct() {

		$this->add(array(
			'name' => 'name',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array('name' => 'NotEmpty',
					  'options' => array(
					  	'messages' => array(
					  		'isEmpty' => 'Não pode estar em branco'
					  )),
				),
			),
		));

        $this->add(array(
                'name' => 'login',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'NotEmpty',
                          'options' => array(
                              'messages' => array(
                                  'isEmpty' => 'Não pode estar em branco'
                              )),
                    ),
                ),
            ));

		$validator = new \Zend\Validator\EmailAddress;
		$validator->setOptions(array('domain' => false));
		$this->add(array(
			'name' => 'email',
			'validators' => array($validator),
		));

		$this->add(array(
			'name' => 'password',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array('name' => 'NotEmpty',
					  'options' => array(
					  	'messages' => array(
					  		'isEmpty' => 'Não pode estar em branco'
					  )),
				),
			),
		));

		$this->add(array(
			'name' => 'confirmation',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array('name' => 'NotEmpty',
				      'options' => array(
					  'messages' => array(
					  		'isEmpty' => 'Não pode estar em branco'
					  )),

					  'name' => 'identical',
					  'options' => array(
					  	'token' => 'password',
					  ),
				),
			),
		));
	}

}