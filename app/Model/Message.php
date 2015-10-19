<?php 

App::uses('Message', 'Model');

class Message extends AppModel {

    var $uses = array('Message');

	public $validate = array(
		'to_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Recipient is required.'
            )
        ),
        'content' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Message content must not be empty.'
            ),
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Message content must not be empty.',
				'allowEmpty' => false
            )
        )
    );

    
}