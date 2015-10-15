<?php
App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');

class User extends AppModel {

	public $uploadDir = 'uploads';

	public $validate = array(
        'name' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required',
				'allowEmpty' => false
            ),
			'between' => array( 
				'rule' => array('between', 5, 20), 
				'required' => true, 
				'message' => 'Name must be between 5 to 20 characters'
			),
			'alpha' => array(
				'rule'    => array('alpha'),
				'message' => 'Name can only be letters'
			),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            ),
			'min_length' => array(
				'rule' => array('minLength', '3'),  
				'message' => 'Password must have a mimimum of 3 characters'
			)
        ),		
		'password_confirm' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please confirm your password'
            ),
			 'equaltofield' => array(
				'rule' => array('equaltofield','password'),
				'message' => 'Both passwords must match.'
			)
        ),		
		'email' => array(
			'required' => array(
				'rule' => array('email', true),    
				'message' => 'Please provide a valid email address.'    
			),
			 'unique' => array(
				'rule'    => array('isUniqueEmail'),
				'message' => 'This email is already in use',
			),
			'between' => array( 
				'rule' => array('between', 6, 80), 
				'message' => 'Email must be between 6 to 80 characters'
			)
		),				
		'password_update' => array(
			'min_length' => array(
				'rule' => array('minLength', '6'),   
				'message' => 'Password must have a mimimum of 6 characters',
				'allowEmpty' => true,
				'required' => false
			)
        ),
		'password_confirm_update' => array(
			 'equaltofield' => array(
				'rule' => array('equaltofield','password_update'),
				'message' => 'Both passwords must match.',
				'required' => false,
			)
        )
    );

	function isUniqueEmail($check) {
		$email = $this->find(
			'first',
			array(
				'fields' => array(
					'User.id'
				),
				'conditions' => array(
					'User.email' => $check['email']
				)
			)
		);

		if (!empty($email)) {
			if ($this->data[$this->alias]['id'] == $email['User']['id']) {
				return true; 
			} else {
				return false; 
			}
		} else {
			return true; 
		}
    }

    public function updateLastLoginTime($id, $lastLoginTime) {
		$sql = "update users set last_login_time = '{$lastLoginTime}' where id={$id}";
		$this->query($sql);
	}
	
	public function alphaNumericDashUnderscore($check) {
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }

    public function alpha($check) {
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z \-]*$/', $value);
    }
	
	public function equaltofield($check,$otherfield) { 
        $fname = ''; 
        foreach ($check as $key => $value){ 
            $fname = $key; 
            break; 
        } 
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname]; 
    } 

	 public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		if (isset($this->data[$this->alias]['password_update'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
		}

		if (!empty($this->data[$this->alias]['filepath'])) {
			$this->data[$this->alias]['filename'] = $this->data[$this->alias]['filepath'];
		}

		return parent::beforeSave($options);
	}

	public function beforeValidate($options = array()) {
		// ignore empty file - causes issues with form validation when file is empty and optional
		if (!empty($this->data[$this->alias]['filename']['error']) && $this->data[$this->alias]['filename']['error']==4 && $this->data[$this->alias]['filename']['size']==0) {
			unset($this->data[$this->alias]['filename']);
		}

		parent::beforeValidate($options);
	}

}

?>