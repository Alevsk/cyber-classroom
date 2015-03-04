<?php

class Answer extends Model {

  var $name = 'Answer';
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


