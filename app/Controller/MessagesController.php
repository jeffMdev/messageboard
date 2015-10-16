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
				    ) order by msg.created desc";

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

	public function messageDetail($id = null) {
		if($this->Message->find('count', array('Message.id' => $id)) > 0) {
			$ses_id = $this->Session->read('Auth.User.id');
			$sql = "select msg.*, usr.id, usr.name, usr.image 
					from messages as msg
					join users as usr
					on usr.id = msg.from_id
					where msg.to_id in ({$ses_id},{$id}) AND msg.from_id in ({$ses_id},{$id})
					order by msg.created desc";

			$messages = $this->Message->query($sql);			

			$this->set('messages', $messages);
		} else {
			$this->redirect(array('controller' => 'messages', 'action' => 'index'));
		}
	}

	public function replyAjax() {

		if( $this->request->is('ajax') ) {
		 	 $this->request->data['from_id'] = $this->Session->read('Auth.User.id');
		 	 $this->request->data['image'] = $this->Session->read('Auth.User.image');
		 	 $message_content = $this->request->data['content'];
		     $this->Message->create();
		     if ($this->Message->save($this->request->data)) {
		     	$msg_id = $this->Message->getLastInsertId();

		     	echo json_encode(array(
		     		'last_msg_id' => $msg_id,
		     		'message' => $message_content,
		     		'created' => date('F d, Y g:i A', strtotime(date('Y-m-d H:i:s'))),
		     		'image' => $this->Session->read('Auth.User.image'),
		     		'sender_name' => $this->Session->read('Auth.User.name')
		     	));
		     }
	    }
	}

	public function deleteMessage() {

		if($this->request->is('ajax')) {
			if(!empty($this->request->data)) {
				if ($this->Message->delete($this->request->data)) {
					echo true;
				} else {
					echo false;
				}
			}
		} 
	}

	public function deleteMessagesWithFromOrTo($id = null) {

		if($this->request->is('ajax')) {
			$id = $this->request->data['id'];
			$msg = $this->Message->findById($id);
			$from_id = $msg['Message']['from_id'];
			$to_id = $msg['Message']['to_id'];

			$sql = "delete from messages where from_id in ({$from_id},{$to_id}) and to_id in ({$from_id},{$to_id})";

			$this->Message->query($sql, $cachequeries = false);
			echo true;
		} 
	}
}