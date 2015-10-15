<?php 

class Message extends AppModel {

	public $validate = array(
		'to_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Recipient is required.'
            )
        ),
        'content' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Message content is required.',
				'allowEmpty' => false
            )
        )
    );

	public function getMessageList() {
		// return $this->Message->find('all');		
	}
}