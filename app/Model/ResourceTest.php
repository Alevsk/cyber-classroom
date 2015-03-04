<?php

class ResourceTest extends Model {

  var $name = 'ResourceTest';
  var $useTable = 'resource_test';

  var $belongsTo = array(
    'Resource' => array(
        'className' => 'Resource',
        'foreignKey' => 'resource_id',
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