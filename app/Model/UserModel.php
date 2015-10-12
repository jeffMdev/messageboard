<?php

App::uses('Model', 'Model');

class UserModel extends Model {
	// public function beforeSave($options = array()) {
	//     if (isset($this->data[$this->alias]['password'])) {
	//         $passwordHasher = new BlowfishPasswordHasher();
	//         $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
	//     }
	//     return true;
	// }

}
