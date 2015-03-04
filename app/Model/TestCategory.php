<?php

class TestCategory extends Model {

  	var $name = 'TestCategory';
  	var $useTable = 'test_categories';
	var $validate = array();

	var $hasMany = array(
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'test_category_id',
			'conditions' => '',
			'fields' => '',
		'order' => ''
		),
		'Test' => array(
			'className' => 'Test',
			'foreignKey' => 'test_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

}

?>