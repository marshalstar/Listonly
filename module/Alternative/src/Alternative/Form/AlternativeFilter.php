<?php

namespace Alternative\Form;

use Zend\InputFilter\InputFilter;

class AlternativeFilter extends InputFilter {
	
	public function __construct() {

		$this->add(array(
			'name' => 'text',
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
            'name' => 'type',
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

	}

}