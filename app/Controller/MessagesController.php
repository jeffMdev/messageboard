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
				    ) order by msg.created desc limit 5";

		$messages = $this->Message->query($sql);		

		$data = array(
			'messages' => $messages,
			'totalRows' => $this->countMessageList($ses_id)
			);			
		$this->set($data);
	}

	public function newMessage() {
		if ($this->request->is('post')) {
			$this->Message->create();
			$this->request->data['Message']['from_id'] = $this->Session->read('Auth.User.id');
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash('Message sent!');
				$this->redirect(array('controller' => 'messages', 'action' => 'index'));
			} else {
				$msg = '';
				if ($this->request->data['Message']['to_id'] == '') $msg .= 'Recipient is required.';
				if ($this->request->data['Message']['content'] == '') $msg .= 'Message content must not be empty.';
				$this->Session->setFlash($msg, 'default', 'bad');
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
					order by msg.created desc limit 5";

			$messages = $this->Message->query($sql);			

			$data = array(
				'messages' => $messages,
				'totalRows' => $this->countMessageDetails($id, $ses_id)
				);
			$this->set($data);
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

	/** Message List **/
	public function showMore($limit = 0, $range = 0) {

		if($this->request->is('ajax')) {
			$limit = $this->request->data['limit'];
			$range = $this->request->data['range'];
			$ses_id = $this->Session->read('Auth.User.id');
			$totalRows = $this->countMessageList($ses_id);
			$messages = $this->getMoreMessageList($limit, $range, $ses_id);			

			$data = '';
			if($messages) {
				foreach ($messages as $message) {
					if ($message['msg']['from_id'] != $this->Session->read('Auth.User.id')) : 
						$imgSrc = $this->request->webroot . 'app/webroot/img/pic_00.jpg';
						if (!empty($message['usr']['image'])) {
						$imgSrc = $this->request->webroot . 'app/webroot/img/profile_img/' . $message['usr']['image'];
						}
						$data .= '<div class="ajax-massage alert alert-success alert-dismissable" id="' . $message['msg']['id'] . '">               
		                    <ul class="list-unstyled">
		                    	<li class="navbar-left">
			                    	<img src="' . $imgSrc . '" class="img-thumbnail" width="60" height="60" class="img-thumbnail" style="margin-right:10px;">
		                    	</li>
		                    	<li class="h4">' . $message['usr']['name'] . '</li>
		                    	<li class="h6">' . $message['msg']['content'] . '</li>
		                    	<li class="text-info h6">' . date('F d, Y g:i A', strtotime($message['msg']['created'])) . '</li>
		                    	<li>
		                    		<a href="' . $this->request->webroot . 'messages/messagedetail/' . $message['msg']['from_id'] . '" class="btn btn-warning">View Details</a>
		                    		<button class="dels btn btn-danger" id="del' . $message['msg']['id'] . '">Delete Message</button>
		                    	</li>
		                    </ul>
	                	</div>';
                	else : 
                		$imgSrc = $this->request->webroot .'app/webroot/img/pic_00.jpg';
						if (!empty($message['usr']['image'])) {
							$imgSrc = $this->request->webroot . 'app/webroot/img/profile_img/' . $message['usr']['image'];
						}
                		$data .= '<div class="ajax-massage alert alert-info alert-dismissable" id="' . $message['msg']['id'] . '">               
		                    <ul class="list-unstyled">
		                    	<li class="navbar-right">
			                    	<img src="' . $imgSrc . '" class="img-thumbnail" width="60" height="60" class="img-thumbnail" style="margin-right:10px;">
		                    	</li>
		                    	<li class="h4">' . $message['usr']['name'] . '</li>
		                    	<li class="h6">' . $message['msg']['content'] . '</li>
		                    	<li class="text-info h6">' . date('F d, Y g:i A', strtotime($message['msg']['created'])) . '</li>
		                    	<li>
		                    		<a href="' . $this->request->webroot . 'messages/messagedetail/' . $message['msg']['to_id'] . '" class="btn btn-warning">View Details</a>
		                    		<button class="dels btn btn-danger" id="del' . $message['msg']['id'] . '">Delete Message</button>
		                    	</li>
		                    </ul>
	                	</div>';
					endif;
				}
			echo json_encode(array(
				'limit' => $limit,
				'range' => $range,
				'htm' => $data,
				'totalRows' =>$totalRows
				));
			}
			return null;
		}

	}

	public function countMessageList($ses_id = 0) {
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
            return count($messages);
    }

    public function getMoreMessageList($limit = 0, $range = 0, $ses_id = 0) {

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
                        ) order by msg.created desc limit {$range},{$limit}";
            $messages = $this->Message->query($sql);
            return $messages;        
    }
	/** End Message List **/

	/** End Message Details **/
	public function showMoreMessageDetails($limit = 0, $range = 0, $id = 0) {

		if($this->request->is('ajax')) {
			$limit = $this->request->data['limit'];
			$range = $this->request->data['range'];
			$id = $this->request->data['id'];
			$ses_id = $this->Session->read('Auth.User.id');
			$totalRows = $this->countMessageDetails($id, $ses_id);
			$messages = $this->getMoreMessageDetails($limit, $range, $id, $ses_id);			

			$data = '';
			if($messages) {
				foreach ($messages as $message) {
					if ($message['msg']['from_id'] != $this->Session->read('Auth.User.id')) : 
						$imgSrc = $this->request->webroot . 'app/webroot/img/pic_00.jpg';
						if (!empty($message['usr']['image'])) {
						$imgSrc = $this->request->webroot . 'app/webroot/img/profile_img/' . $message['usr']['image'];
						}
						$data .= '<div class="ajax-massage alert alert-success alert-dismissable" id="' . $message['msg']['id'] . '">               
		                    <ul class="list-unstyled">
		                    	<li class="navbar-left">
			                    	<img src="' . $imgSrc . '" class="img-thumbnail" width="60" height="60" class="img-thumbnail" style="margin-right:10px;">
		                    	</li>
		                    	<li class="h4">' . $message['usr']['name'] . '</li>
		                    	<li class="h6">' . $message['msg']['content'] . '</li>
		                    	<li class="text-info h6">' . date('F d, Y g:i A', strtotime($message['msg']['created'])) . '</li>
		                    	<li><button class="dels btn btn-danger" id="del' . $message['msg']['id'] . '">Delete Message</button></li>
		                    </ul>
	                	</div>';
                	else : 
                		$imgSrc = $this->request->webroot .'app/webroot/img/pic_00.jpg';
						if (!empty($message['usr']['image'])) {
							$imgSrc = $this->request->webroot . 'app/webroot/img/profile_img/' . $message['usr']['image'];
						}
                		$data .= '<div class="ajax-massage alert alert-info alert-dismissable" id="' . $message['msg']['id'] . '">               
		                    <ul class="list-unstyled">
		                    	<li class="navbar-right">
			                    	<img src="' . $imgSrc . '" class="img-thumbnail" width="60" height="60" class="img-thumbnail" style="margin-right:10px;">
		                    	</li>
		                    	<li class="h4">' . $message['usr']['name'] . '</li>
		                    	<li class="h6">' . $message['msg']['content'] . '</li>
		                    	<li class="text-info h6">' . date('F d, Y g:i A', strtotime($message['msg']['created'])) . '</li>
		                    	<li><button class="dels btn btn-danger" id="del' . $message['msg']['id'] . '">Delete Message</button></li>
		                    </ul>
	                	</div>';
					endif;
				}
			echo json_encode(array(
				'limit' => $limit,
				'range' => $range,
				'htm' => $data,
				'totalRows' =>$totalRows
				));
			}
			return null;
		}

	}

	public function countMessageDetails($id = 0, $ses_id = 0) {
        $sql = "select msg.*, usr.id, usr.name, usr.image 
				from messages as msg
				join users as usr
				on usr.id = msg.from_id
				where msg.to_id in ({$ses_id},{$id}) AND msg.from_id in ({$ses_id},{$id})
				order by msg.created desc";

		$messages = $this->Message->query($sql);
        return count($messages);
	}

    public function getMoreMessageDetails($limit = 0, $range = 0, $id = 0, $ses_id = 0) {

           $sql = "select msg.*, usr.id, usr.name, usr.image 
					from messages as msg
					join users as usr
					on usr.id = msg.from_id
					where msg.to_id in ({$ses_id},{$id}) AND msg.from_id in ({$ses_id},{$id})
					order by msg.created desc limit {$range},{$limit}";

			$messages = $this->Message->query($sql);
            return $messages;        
    }
}