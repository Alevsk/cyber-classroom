<?php

class User extends Model {

  var $name = 'User';

  var $validate = array(
        'username' => array(
            'required' => true,
            'unique' => array(
                        'rule'    => 'isUnique',
                        'message' => "La matricula ya existe"
                    ),
        ),
        'password' => array(
            'required' => true
        ),
        'email' => array(
                    'email' => array(
                        'rule'    => array('email'),
                        'message' => "Escribe una direccion de correo valida",
                    ),
                    'unique' => array(
                            'rule'    => 'isUnique',
                            'message' => "El email ya existe"
                        ),
                )
    );

    var $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

	var $hasMany = array(
		'Test' => array(
    		'className' => 'Test',
    		'foreignKey' => 'user_id',
    		'conditions' => '',
    		'fields' => '',
    		'order' => '',
            'dependent'=> true,
		),
        'Question' => array(
            'className' => 'Question',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
	);

}

?>