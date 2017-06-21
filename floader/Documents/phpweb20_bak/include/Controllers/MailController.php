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
  	    	
            $newMessages = DatabaseObject_Mail::GetMessages(
            		$this->db,
            		$options
            );
            
             // get the total number of messages for this user
            $totalMessages = DatabaseObject_Mail::GetMessageCount(
                $this->db,
                array('from_id' => $toId,
					  'to_id'   => $this->identity->user_id,
					  'message_status' => 'New'                
            ));         
   
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
            
            $this->message = new DatabaseObject_Mail($this->db);
            $this->message->load($message_id);
            $this->message->markAsRead();
            $this->message->save();
            if ($this->identity->newMessages != 0){
            	$this->identity->newMessages = $this->identity->newMessages - 1;
            } 
            
			$this->identity->subject = $this->message->profile->subject;
			$this->identity->name = $this->message->profile->from;
			$this->view->profile = $this->message->profile;
			$body = $this->decrypt($this->message->profile->body,$this->encKey,$this->iv,$this->bit_check);
			$this->view->body = strip_tags($body);                       
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

            $fp = new FormProcessor_NewMessage($this->db,
                                             $this->identity->user_id);                                

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
        	
        	// assign the identity to the template
        	$this->view->user_type = $this->identity->user_type;
        	$this->view->session = Zend_Registry::get('config')->session->cost;
        	$this->view->returnurl = Zend_Registry::get('config')->website->url;
        	$this->view->business = Zend_Registry::get('config')->paypal->business;
        	$this->encKey = Zend_Registry::get('config')->enc->enckey;
        	$this->iv = Zend_Registry::get('config')->enc->iv;
        	
        	if ($this->identity->user_type != 'member') {
        		foreach ($this->identity->clients as $value) {
			 		$profile = new Profile_User($this->db,$value);
			 		$profile->load();
			 		if($profile->status == "Accepted"){
			 			$clientsProcessed=true;
			 		}
			 		$clients[$index]['name'] =  trim($profile->first_name. ' ' .$profile->last_name);
			 		$index++;
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
                if ($fp->process($request)) {
                    $this->_redirect('/mail/send');
                }
            } 

            $this->view->fp = $fp;
        	
        }
        
        public function sendAction(){
        	   $this->view->user_type = $this->identity->user_type;
        	
        		if ($this->identity->user_type == 'member'){
        			  // assign number of credits to template
        		  	$this->view->credits = $this->identity->credits;
        		  	$this->view->recipient = 'therapist';
        		}
        		else {
        			$this->view->recipient = 'client';
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