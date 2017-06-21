<?php
    class ClientProcessor_NewClients
    {
        protected $db = null;
        public $user = null;
        public $message = null;
        public $oremarks = null;

        public function __construct($db, $user_id)
        {
            $this->db = $db;

            $this->user = new DatabaseObject_User($db);
            $this->user->load($user_id);
                                     
            $this->identity = Zend_Auth::getInstance()->getIdentity();
            $this->identity->current_client = $this->user->profile->first_name . ' ' .
                              $this->user->profile->last_name;                                      
        }
 
      	public function sendEmail($tpl, $action)
        {
            $templater = new Templater();
            $templater->user = $this->user;
			$templater->url = Zend_Registry::get('config')->website->url;
			$templater->website = Zend_Registry::get('config')->website->name;
            
            // fetch the e-mail body
            $body = $templater->render('email/' . $tpl);

            // extract the subject from the first line
            list($subject, $body) = preg_split('/\r|\n/', $body, 2);

	    $body .= "\n\n".$this->oremarks;
            try {
            // now set up and send the e-mail
            $mail = new Zend_Mail();
	            
            // set the to address and the user's full name in the 'to' line
            $mail->addTo($this->user->profile->email,
                         trim($this->user->profile->first_name . ' ' .
                              $this->user->profile->last_name));                 

            // get the admin 'from' details from the config
            $mail->setFrom(Zend_Registry::get('config')->email->from->email,
            Zend_Registry::get('config')->email->from->name);

            // set the subject and body and send the mail
            $mail->setSubject(trim($subject));
            $mail->setBodyText(trim($body));
            
              	if ($action == 'accept'){
              		$path = Zend_Registry::get('config')->paths->ssl;
              		$filename = $this->user->username;
              		$fileContents = file_get_contents($path.$filename.'.p12');
              		
              		if (!$fileContents){
              			$this->identity->error = "Unable to send e-mail. The digital cert file: $filename.p12 does not exist";
              			return false;
              			
              		} else {
              		    $attachment = $mail->createAttachment($fileContents);  
              			$attachment->filename = $filename.'.p12';
              			$mail->send(); 	
              			
              			return true;	
              		}
              		
              	}	          
            
                } catch (Zend_Exception $e) {
        		$this->identity->error = $e->getMessage(); 
        		return false;
        	}	
        
        	
        }       

    	public function sendTextMessage($tpl)
        {
        	$templater = new Templater();
            $templater->user = $this->user;
            $templater->website = Zend_Registry::get('config')->website->name;
            
   			$path = Zend_Registry::get('config')->paths->ssl;
            $filename = $this->user->username;            
			$fileContents = file_get_contents($path.$filename.'.txt');  


            // fetch the text body
            $textBody = $templater->render('mobile/' . $tpl);
            $body = $textBody.$fileContents;
 
            $url = Zend_Registry::get('config')->webtext->url; 					
			$id = Zend_Registry::get('config')->webtext->id;
			$password = Zend_Registry::get('config')->webtext->password;
			$tag = Zend_Registry::get('config')->webtext->tag;
			$mobile = trim($this->user->profile->mobile); 			 
			$post = "api_id=$id&api_pwd=$password&txt=$body&dest=$mobile&tag=$tag";
			
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$url);
			curl_setopt ($curl_handle, CURLOPT_POSTFIELDS, $post);
			curl_exec($curl_handle);
			curl_close($curl_handle);
  
            }               
        
        public function updateStatus($action){
        	if ($action == 'accept'){
         		$this->user->profile->status = 'Accepted';	
         	} else {
         		$this->user->profile->status = 'Rejected';
         	}
         	
         	$this->user->profile->save();
				
        }
        
    }
?>
