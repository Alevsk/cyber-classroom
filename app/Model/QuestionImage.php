<?php

class QuestionImage extends Model {

  var $name = 'QuestionImage';
  var $useTable = 'question_images';
	var $validate = array();

  var $belongsTo = array(
	  'Question' => array(
	    'className' => 'Question',
	    'foreignKey' => 'question_id',
	    'conditions' => '',
	    'fields' => '',
	    'order' => ''
	  )
  );

}

?>