<?php

class Test extends Model {

    var $name = 'Test';

    /*var $validate = array(
        'name' => array(
            'alphaNumeric' => array(
                'required' => true
            )
        )
    );*/

    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
         'TestCategory' => array(
            'className' => 'TestCategory',
            'foreignKey' => 'test_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
          ),
    );

	var $hasMany = array(
		'Question' => array(
    		'className' => 'Question',
    		'foreignKey' => 'test_id',
    		'conditions' => '',
    		'fields' => '',
    		'order' => '',
            'dependent'=> true,
		),
        'ResourceTest' => array(
            'className' => 'ResourceTest',
            'foreignKey' => 'test_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'dependent'=> true,
        ),
	);

}

?>