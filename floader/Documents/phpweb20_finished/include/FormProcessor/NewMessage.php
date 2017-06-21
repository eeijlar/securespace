<?php
    class FormProcessor_NewMessage extends FormProcessor
    {
        static $tags = array(
            'a'      => array('href', 'target', 'name'),
            'img'    => array('src', 'alt'),
            'b'      => array(),
            'strong' => array(),
            'em'     => array(),
            'i'      => array(),
            'ul'     => array(),
            'li'     => array(),
            'ol'     => array(),
            'p'      => array(),
            'nbsp'   => array(),
            'br'     => array()
         );

        protected $db = null;
        public $user = null;
        public $message = null;
 		protected $encKey;
		protected $iv;
		protected $bit_check=8;// bit amount for diff algor.

        public function __construct($db, $user_id)
        {
            parent::__construct();

            $this->db = $db;

            $this->user = new DatabaseObject_User($db);
            $this->user->load($user_id);

            $this->message = new DatabaseObject_Mail($db);

            if ($this->message->isSaved()) {
            }
            else {
            	$this->message->from_id = $this->user->getId();
            }
                           
            $this->identity = Zend_Auth::getInstance()->getIdentity();    
        }

        public function process(Zend_Controller_Request_Abstract $request)
        {   
        $this->identity = Zend_Auth::getInstance()->getIdentity();
        	if($this->identity->subject != null) {
        		$this->subject = 'Re: '.$this->identity->subject;
        		$name =  $this->identity->name;               
        		
        	} else {
        		$name =  $request->getPost('client');
	            // process the subject
	            $this->subject = $this->sanitize($request->getPost('subject'));
	            $this->subject = substr($this->subject, 0, 255);
	
	            if (strlen($this->subject) == 0)
	                $this->addError('subject', 'Please enter a subject for this message');		        		
        	}

			//
			$this->message->profile->subject=$this->subject;
            
            // 2008-08-18 21:48:00
            $this->ts_created = date("Y-m-d H:i:s", time()); 

            $this->body = $this->cleanHtml($request->getPost('body'));
            if (strlen($this->body) == 0)
                $this->addError('body', 'Please enter text for this message');		


            // if no errors have occurred, save the message
            if (!$this->hasError()) {
            	$this->encKey = Zend_Registry::get('config')->enc->enckey;
        		$this->iv = Zend_Registry::get('config')->enc->iv;
            	$this->message->ts_created = $this->ts_created;
                $this->message->profile->subject = $this->subject;              
                $this->message->profile->body = $this->encrypt($this->body,$this->encKey,$this->iv,$this->bit_check);
				
                if($this->user->user_type == 'member'){   	
                	$this->message->profile->to = $this->user->profile->sme;
                	$this->message->to_id =  $this->identity->sme_id;
                }
                else {
                	$index=0;
                	
                	
                	foreach ($this->identity->clients as $value) {
			 			$profile = new Profile_User($this->db,$value);
			 			$profile->load();		 			
			 			if (trim($profile->first_name. ' ' .$profile->last_name) ==  $name){
			 				$filters = array('user_id' => (int) $value);	 				
			 				$this->message->to_id = $filters['user_id'];
			 				break;
			 			}
			 		$index++;	
			 		}  
                	$this->message->profile->to = $name;
                }
                
                
                $this->message->send($this->user->profile->first_name.' '.$this->user->profile->last_name);
                
                $this->message->save();
                if($this->user->user_type == 'member')
                	$this->decrementCredits();

            }

            // return true if no errors have occurred
            return !$this->hasError();
        }


        public function cleanHtml($html)
        {
            $chain = new Zend_Filter();
            $chain->addFilter(new Zend_Filter_StripTags(self::$tags));
            $chain->addFilter(new Zend_Filter_StringTrim());

            $html = $chain->filter($html);

            $tmp = $html;
            while (1) {
                // Try and replace an occurrence of javascript:
                $html = preg_replace('/(<[^>]*)javascript:([^>]*>)/i',
                                     '$1$2',
                                     $html);

                // If nothing changed this iteration then break the loop
                if ($html == $tmp)
                    break;

                $tmp = $html;
            }

            return $html;
        }
        
        public function decrementCredits()
        {  	
        	
        	$credits = $this->user->profile->credits;
        	$credits = (integer) trim($credits);
        	      		
        		if ($credits == 1) {
        			// weird errors if this is $credits=0, tries to delete profile.
        			$credits = " 0 ";
        		}
        	    else {
        	    	$credits = $credits - 1;
        	    } 
        	      			    		
        	$this->user->profile->credits = (string)$credits;
        	$this->identity->credits = (string) $credits;
        	$this->user->profile->save(); 
        	return true;
        }  
    
 }
    
?>
