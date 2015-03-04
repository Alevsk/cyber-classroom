<?php

class Group extends Model {

  var $name = 'Group';
  //var $validate = array();

	var $hasMany = array(
		'User' => array(
		'className' => 'User',
		'foreignKey' => 'group_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''
		),
	);

}

?>