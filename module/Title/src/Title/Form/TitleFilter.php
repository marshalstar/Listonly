<?php

namespace Title\Form;

use Zend\InputFilter\InputFilter;

class TitleFilter extends InputFilter {
	
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
            'name' => 'calculation',
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