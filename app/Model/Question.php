<?php

class Question extends Model {

  var $name = 'Question';
	var $validate = array();

  var $belongsTo = array(
	 'TestCategory' => array(
	    'className' => 'TestCategory',
	    'foreignKey' => 'test_category_id',
	    'conditions' => '',
	    'fields' => '',
	    'order' => ''
	  ),
    'QuestionType' => array(
	    'className' => 'QuestionType',
	    'foreignKey' => 'question_type_id',
	    'conditions' => '',
	    'fields' => '',
	    'order' => ''
	  ),
     'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
       ),
  );

  var $hasMany = array(
	  'Answer' => array(
	    'className' => 'Answer',
	    'foreignKey' => 'question_id',
	    'conditions' => '',
	    'fields' => '',
	    'order' => '',
	    'dependent'=> true,
	  ),
    'QuestionImage' => array(
	    'className' => 'QuestionImage',
	    'foreignKey' => 'question_id',
	    'conditions' => '',
	    'fields' => '',
	    'order' => '',
	    'dependent'=> true,
	  )

  );

  var $actsAs = array('Containable');

}

?>

