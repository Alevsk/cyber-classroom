<?php

class UserTestAnswers extends Model {

  var $name = 'UserTestAnswer';
  var $useTable = 'user_test_answers';

  var $belongsTo = array(
    'UserTestAccomplished' => array(
        'className' => 'UserTestAccomplished',
        'foreignKey' => 'user_test_accomplished_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    ),
  );

}

?>