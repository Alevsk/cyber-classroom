<?php

class QuestionType extends Model {

  var $name = 'QuestionType';
  var $useTable = 'question_types';
	var $validate = array();

  var $hasMany = array(
	  'Question' => array(
	    'className' => 'Question',
	    'foreignKey' => 'question_type_id',
	    'conditions' => '',
	    'fields' => '',
	    'order' => ''
	  )
  );

}

?>


