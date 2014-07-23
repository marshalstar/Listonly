<?php

namespace Question\Form;

use Zend\InputFilter\InputFilter;

class QuestionFilter extends InputFilter {
	
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

	}

}