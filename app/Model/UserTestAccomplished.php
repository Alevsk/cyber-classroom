<?php

class UserTestAccomplished extends Model {

  var $name = 'UserTestAccomplished';
  var $useTable = 'user_test_accomplished';

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

  var $hasMany = array(
    'UserTestAnswer' => array(
        'className' => 'UserTestAnswer',
        'foreignKey' => 'user_test_accomplished_id',
        'conditions' => '',
        'fields' => '',
        'order' => '',
        'dependent'=> true,
    ),
  );

}

?>