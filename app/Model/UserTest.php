<?php

class UserTest extends Model {

  var $name = 'UserTest';
  var $useTable = 'user_test';

  var $belongsTo = array(
    'User' => array(
        'className' => 'User',
        'foreignKey' => 'user_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    ),
   'Test' => array(
        'className' => 'Test',
        'foreignKey' => 'test_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    ),
);

}

?>