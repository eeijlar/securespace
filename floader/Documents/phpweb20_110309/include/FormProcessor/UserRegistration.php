<?php
    class FormProcessor_UserRegistration extends FormProcessor
    {
        protected $db = null;
        public $user = null;
        public $status = 'Pending';
        protected $sme_id = null;
        protected $_validateOnly = false;

        public function __construct($db)
        {
            parent::__construct();
            $this->db = $db;
            $this->user = new DatabaseObject_User($db);
            $this->user->type = 'member';
        }
        
        public function validateOnly($flag){
        	$this->_validateOnly = (bool) $flag;
        }
        
        public function getSME($sme_id){
        	
        	$charCheck =ereg_replace("[^0-9]","",$sme_id);   	
        	$this->sme_id = $this->sanitize($charCheck);	
            	
        	if ($this->sme_id != "") {
        		$this->user->load($this->sme_id);
        		
        		if($this->user->user_type == 'member'){
        			$this->addError('sme', 'The id specified is the wrong member type');
        			return 'error';
        		}
        		else if (strlen($this->user->profile->first_name) == 0 || strlen($this->user->profile->last_name)==0){	
        			$this->addError('sme', 'The therapist selected does not exist');
        			return 'error';
        			
        		} else {
        			$name = sprintf('%s%s%s',$this->user->profile->first_name," ",$this->user->profile->last_name);  			
        			return $name;
        		}  		
        	} 
        	else {
        		$this->addError('sme', 'Invalid therapist id');
        		return 'error';
        	}
        	
        }

        public function process(Zend_Controller_Request_Abstract $request)
        {
            // validate the user's name
            $this->first_name = trim($this->sanitize($request->getPost('first_name')));
            if (strlen($this->first_name) == 0)
                $this->addError('first_name', 'Please enter your first name');
            else
                $this->user->profile->first_name = $this->first_name;

			// validate the user's last name
            $this->last_name = trim($this->sanitize($request->getPost('last_name')));
            if (strlen($this->last_name) == 0)
                $this->addError('last_name', 'Please enter your last name');
            else
                $this->user->profile->last_name = $this->last_name;

            // validate the username
            $this->username = trim($request->getPost('username'));

            if (strlen($this->username) == 0)
                $this->addError('username', 'Please enter a username');
            else if (!DatabaseObject_User::IsValidUsername($this->username))
                $this->addError('username', 'Please enter a valid username');
            else if ($this->user->usernameExists($this->username))
                $this->addError('username', 'The selected username already exists');
            else
                $this->user->username = $this->username;

            // validate the e-mail address
            $this->email = trim($this->sanitize($request->getPost('email')));
            $validator = new Zend_Validate_EmailAddress(Zend_Validate_Hostname::ALLOW_DNS, true);

            if (strlen($this->email) == 0)
                $this->addError('email', 'Please enter your e-mail address');
            else if (!$validator->isValid($this->email))
                $this->addError('email', 'Please enter a valid e-mail address');
           
            
            // validate the e-mail verification
            $this->verify_email = trim($this->sanitize($request->getPost('verify_email')));
            $validator = new Zend_Validate_EmailAddress(Zend_Validate_Hostname::ALLOW_DNS, true);

            if (strlen($this->verify_email) == 0)
                $this->addError('verify_email', 'Please re-enter your e-mail address');
            else if (!$validator->isValid($this->email))
                $this->addError('verify_email', 'Please enter a valid e-mail address');
            else if ($this->email != $this->verify_email)
            	 $this->addError('verify_email', 'E-mail addresses do not match');
            else
                $this->user->profile->email = $this->email;     

			// validate the mobile number
			
			$country_code = trim(str_replace('+','00',$this->sanitize($request->getPost('countryCode'))));	
     
            if (preg_match("/\D+/",$country_code)) 
            	$this->addError('local_number','Country code contains invalid characters');
            else if(strlen($country_code)==0)
            	$this->addError('local_number', 'International dial code is invalid. Ensure java script is enabled in your browser.');
            else 
            	$this->country_code = trim($country_code); 	
                  
           	$area_code = trim($this->sanitize($request->getPost('area_code')));
  
           	if (preg_match("/\D+/",$area_code))
           		$this->addError('local_number', 'Area Code contains invalid characters');
           	else if(strlen($area_code)==0)
            	$this->addError('local_number', 'Area Code is blank');
            else
           		$this->area_code = ltrim($area_code,'0');	
			
			$local_number = trim($this->sanitize($request->getPost('local_number')));
           
			if (preg_match("/\D+/",$local_number))  
				$this->addError('local_number', 'Local number contains invalid characters');
			else if(strlen($local_number)==0)
            	$this->addError('local_number', ' Local number is blank');
            else if (strlen($local_number) < 7 || (strlen($local_number) > 7) && $this->country_code=='00353') 
            	$this->addError('local_number', ' Irish mobile numbers have 7 digits, you have: '.strlen($local_number));
			else
				$this->local_number = trim($local_number);            			
						
			$this->mobile = sprintf('%s%s%s',$this->country_code,$this->area_code,$this->local_number);
			$this->user->profile->mobile = $this->mobile; 		       

			// check tandc are selected as on
			$this->tandc = trim($this->sanitize($request->getPost('tandc_radio')));
			
			if($this->tandc == 'No') {
				$this->addError('tandc', 'Verify that you have read the Terms & Conditions');								
			}
			
            // check that sme is selected
            $session = new Zend_Session_Namespace('sme');

            if (!$session->sme){
                $this->addError('sme', 'Please select a therapist');            	
            } else {
            	$this->user->profile->sme = $session->sme;	
            }
                                   
            // validate CAPTCHA phrase
            $session = new Zend_Session_Namespace('captcha');
            $this->captcha = $this->sanitize($request->getPost('captcha'));

            if ($this->captcha != $session->phrase)
                $this->addError('captcha', 'Please enter the correct phrase.');

            // validate story
            $strStory = "";
            $strStory = $this->cleanHtml($request->getPost('story'));
            $this->user->profile->story = $this->sanitize($strStory);
			
			if (strlen($this->user->profile->story) < 200){
				$this->addError('story', 'Please enter your story.');			
			}
			
            // if no errors have occurred, save the user
            if (!$this->_validateOnly && !$this->hasError()) {
            	$this->user->profile->credits = 0;
            	$this->user->profile->status = $this->status;
                $this->user->save();
                unset($session->phrase);
                unset($session->sme);
            }
            // return true if no errors have occurred
            return !$this->hasError();
        }
    }
?>