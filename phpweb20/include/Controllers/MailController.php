<?php
    class MailController extends CustomControllerAction {
    	
    	protected $encKey;
		protected $iv;
		protected $bit_check=8;	

        public function init() {
            parent::init();

           $this->identity = Zend_Auth::getInstance()->getIdentity();
		}

        public function indexAction(){

		}

        public function inboxAction() {
        	// assign the identity to the template
        	$this->view->user_type = $this->identity->user_type;
        	
        	if ($this->identity->user_type == 'member'){
        		$toId = $this->identity->sme_id;
        	} else {
        		$toId = null;
        	}        

  	        $options = array(
  	        	'from_id' => $toId,
  	        	'to_id'   => $this->identity->user_id,
                'order'   => 'p.ts_created desc'
            ); 	
            $newMessages = null;
            $newMessages = DatabaseObject_Mail::GetMessages(
            		$this->db,
            		$options
            );
            
             // get the total number of messages for this user
            $totalMessages = null;
            $totalMessages = DatabaseObject_Mail::GetMessageCount(
                $this->db,
                array('from_id' => $toId,
					  'to_id'   => $this->identity->user_id,
					  'message_status' => 'New'                
            ));         
  
            if($newMessages != null) {
               $this->identity->newMessages = $totalMessages;
            } else {
               $this->identity->newMessages = null;
            }

            $this->view->totalMessages = $totalMessages;
            $this->view->newMessages = $newMessages;            
		}
		
        public function sentAction() {
        	
        	// assign the identity to the template
        	$this->view->user_type = $this->identity->user_type;
        	
        	if ($this->identity->user_type == 'member'){
        		$toId = $this->identity->sme_id;
        	} else {
        		$toId = null;
        	}	    		    	
        		    		    	
  	        $options = array(
  	        	'from_id' => $this->identity->user_id,
  	        	'to_id'   => $toId,
                'order'   => 'p.ts_created desc'
            ); 	
  	    $newMessages = null; 	
            $newMessages = DatabaseObject_Mail::GetMessages(
            		$this->db,
            		$options
            );
            
             // get the total number of messages for this user
            $totalMessages = DatabaseObject_Mail::GetMessageCount(
                $this->db,
                array('from_id' => $this->identity->user_id,
					  'to_id'   => $toId                  
            ));          
   
            $this->view->totalMessages = $totalMessages;
            $this->view->newMessages = $newMessages;            
		}		


        public function viewAction(){
        	// assign the identity to the template
        	$this->view->user_type = $this->identity->user_type;
        	$this->encKey = Zend_Registry::get('config')->enc->enckey;
        	$this->iv = Zend_Registry::get('config')->enc->iv;        	
        	
            $message_id = (int) $this->getRequest()->getQuery('id');
            $session = new Zend_Session_Namespace('messaging');
            $session->fullname = (int) $this->getRequest()->getQuery('from');
            $this->message = new DatabaseObject_Mail($this->db);
            $this->message->load($message_id);
            $this->message->markAsRead();
            $this->message->save();
            if ($this->identity->newMessages != null){
                if($this->identity->newMessages > 0) {
            	   $this->identity->newMessages = $this->identity->newMessages - 1;
                } 
            } 
            
			$this->identity->subject = $this->message->profile->subject;
			$this->identity->name = $this->message->profile->from;
			$this->view->profile = $this->message->profile;
                        if ($this->identity->name == "Secure Counselling") {
                            $this->view->name = "Secure Counselling";
                            $body = $this->message->profile->body;
			} else {
                            $this->view->name = $this->identity->name;
                            $body = $this->decrypt($this->message->profile->body,$this->encKey,$this->iv,$this->bit_check);
                        }
                        $this->view->body = FormProcessor_NewMessage::cleanHtml($body);
        }
 
         public function replyAction(){
        	// assign the identity to the template
        	$this->view->user_type = $this->identity->user_type;
        	$this->view->session = Zend_Registry::get('config')->session->cost;
        	$this->view->returnurl = Zend_Registry::get('config')->website->url;
        	$this->view->business = Zend_Registry::get('config')->paypal->business;
        	$this->identity->id = $this->getRequest()->getQuery('id');
                  	        	
        		if ($this->identity->user_type == 'member'){
        			  // assign number of credits to template
        		  	$this->view->credits = $this->identity->credits;
        		}
        	
        	$request = $this->getRequest();

            $fp = new FormProcessor_NewMessage($this->db,$this->identity->user_id);                                

            if ($request->isPost()) {
                if ($fp->process($request)) {
                    $this->_redirect('/mail/send');
                }
            }

            $this->view->fp = $fp;
        }       
        
        public function newmessageAction(){
        	$index=0;
        	$clients[] =null;
        	$clientsProcessed = false;

                
                // The subject will not be set on a new message. The same code is used in the form processor to process both new and reply msgs, therefore it needs to be null
                // on a new message.  
                $this->identity->subject = null;
        	
        	// assign the identity to the template
        	$this->view->user_type = $this->identity->user_type;
        	$this->view->session = Zend_Registry::get('config')->session->cost;
        	$this->view->returnurl = Zend_Registry::get('config')->website->url;
        	$this->view->business = Zend_Registry::get('config')->paypal->business;
        	$this->encKey = Zend_Registry::get('config')->enc->enckey;
        	$this->iv = Zend_Registry::get('config')->enc->iv;
        	
        	if ($this->identity->user_type != 'member') {
        		foreach ($this->identity->clients as $value) {
                                   if($value != null){
			 		$profile = new Profile_User($this->db,$value);
			 		$profile->load();
			 		if($profile->status == "Application Complete"){
			 			$clientsProcessed=true;
			 		        $clients[$index]['name'] =  trim($profile->first_name. ' ' .$profile->last_name);
                                        }
			 		$index++;
				   }
			 	}

        	if($clientsProcessed){
        		$this->view->clients=$clients;
        	}
        	
        	else {
        		$this->view->noclients=true;
        	}
        	
        	
        	}
        		if ($this->identity->user_type == 'member'){
        			  // assign number of credits to template
        		  	$this->view->credits = $this->identity->credits;
        		}
        	
        	$request = $this->getRequest();

            $fp = new FormProcessor_NewMessage($this->db,
                                             $this->identity->user_id);                                

            if ($request->isPost()) {
                $session = new Zend_Session_Namespace('messaging');
                $session->fullname =$this->getRequest()->getPost('client'); 
                if ($fp->process($request)) {
                    $this->_redirect('/mail/send');
                }
            } 

            $this->view->fp = $fp;
        	
        }
        
        public function sendAction(){
        	   $this->view->user_type = $this->identity->user_type;
                   $user = new DatabaseObject_User($this->db,$this->identity->user_id);	
        	   
                        if ($this->identity->user_type == 'member'){
        			// assign number of credits to template
        		  	$this->view->credits = $this->identity->credits;
        		  	$this->view->recipient = 'therapist';

                                // inform the therapist that the client has sent a mail
                                if($this->identity->sme_id != null) {
                                	$user->profile->setUserId($this->identity->sme_id);
                                	$user->profile->load();
                                	$user->sendEmail('user-mail.tpl');
                                }
        		}
        		else {
        			$this->view->recipient = 'client';
                                // inform the client that the therapist has sent a mail
                                 $session = new Zend_Session_Namespace('messaging');
                                 if (is_int($session->fullname) == false){ 
                                        $clientId = $user->fetchIdFromFullName($session->fullname);
                                 } else {
                                        $clientId = $session->fullname;
                                 } 
                                 if ($clientId != null) {
                                 	$user->profile->setUserId($clientId);
                                 	$user->profile->load();
                                 	$user->sendEmail('user-mail.tpl');
                                 }
        		}
        	
        	
        }

		function decrypt($encrypted_text,$key,$iv,$bit_check){
			$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
			mcrypt_generic_init($cipher, $key, $iv);
			$decrypted = mdecrypt_generic($cipher,base64_decode($encrypted_text));
			mcrypt_generic_deinit($cipher);
			$last_char=substr($decrypted,-1);
			
			for($i=0;$i<$bit_check-1; $i++){
			    if(chr($i)==$last_char){
			       
			        $decrypted=substr($decrypted,0,strlen($decrypted)-$i);
			        break;
			    }
			}
		return $decrypted;
		}       
}
?>
