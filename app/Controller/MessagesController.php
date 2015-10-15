<?php 

class MessagesController extends AppController {

	var $uses = array('User', 'Message');

	public function index() {		

		$ses_id = $this->Session->read('Auth.User.id');

		$sql = "select 
				 msg.*, usr.id, usr.name, usr.image
				from (
				select * from messages as msg1
				where msg1.to_id = {$ses_id} OR msg1.from_id = {$ses_id}
				order by msg1.created desc
				) as msg 
				join users as usr
				on usr.id = msg.from_id
				group by (
				      CASE
				        WHEN msg.from_id = {$ses_id} THEN msg.to_id
				        WHEN msg.to_id = {$ses_id} THEN msg.from_id
				      END
				    ) ";

		$messages = $this->Message->query($sql);
			

		$this->set('messages', $messages);
	}

	public function newMessage() {
		if ($this->request->is('post')) {
			$this->Message->create();
			$this->request->data['Message']['from_id'] = $this->Session->read('Auth.User.id');
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash('Message sent!');
				$this->redirect(array('controller' => 'messages', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sending failed, please try again!'));
			}
		} 
		$users = $this->User->find('all', array('conditions' => array('User.id !=' => $this->Session->read('Auth.User.id'))));
		$this->set('users' , $users);
	}

	public function messageDetail() {

	}

	public function deleteMessage($id = null) {
		if ($this->request->is('post')) {
			if ($this->Message->delete($id)) {
				$this->Session->setFlash('Message has been deleted.');
				$this->redirect(array('controller' => 'messages', 'action' => 'index'));
			}
		}
	}
}