<?php
    class FormProcessor_SmeRegistration extends FormProcessor
    {
        protected $db = null;
        public $user = null;
        public $status = 'Pending';

        public function __construct($db)
        {
            parent::__construct();
            $this->db = $db;
            $this->user = new DatabaseObject_User($db);
            $this->user->user_type = 'sme';
        }

        public function process(Zend_Controller_Request_Abstract $request)
        {
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

            // validate the user's name
            $this->first_name = $this->sanitize($request->getPost('first_name'));
            if (strlen($this->first_name) == 0)
                $this->addError('first_name', 'Please enter your first name');
            else
                $this->user->profile->first_name = $this->first_name;

			// validate the user's last name
            $this->last_name = $this->sanitize($request->getPost('last_name'));
            if (strlen($this->last_name) == 0)
                $this->addError('last_name', 'Please enter your last name');
            else
                $this->user->profile->last_name = $this->last_name;

            // validate the e-mail address
            $this->email = $this->sanitize($request->getPost('email'));
            $validator = new Zend_Validate_EmailAddress(Zend_Validate_Hostname::ALLOW_DNS, true);

            if (strlen($this->email) == 0)
                $this->addError('email', 'Please enter your e-mail address');
            else if (!$validator->isValid($this->email))
                $this->addError('email', 'Please enter a valid e-mail address');

            // validate the e-mail verification
            $this->verify_email = $this->sanitize($request->getPost('verify_email'));
            $validator = new Zend_Validate_EmailAddress(Zend_Validate_Hostname::ALLOW_DNS, true);

            if (strlen($this->verify_email) == 0)
                $this->addError('verify_email', 'Please re-enter your e-mail address');
            else if (!$validator->isValid($this->email))
                $this->addError('verify_email', 'Please enter a valid e-mail address');
            else if ($this->email != $this->verify_email)
            	 $this->addError('verify_email', 'E-mail addresses do not match');
            else
                $this->user->profile->email = $this->email;

            // validate mobile number
            $intlDialCode= $this->sanitize($request->getPost('countryCode'));
            $this->intldialcode = str_replace('+','00',$intlDialCode);
            
            $this->areacode = $this->sanitize($request->getPost('areacode'));
            $this->localnumber = $this->sanitize($request->getPost('localnumber'));
            
            if(strlen($this->areacode)==0 || strlen($this->localnumber)==0 || strlen($this->intldialcode)==0) {
            	$this->addError('mobile', 'Mobile number is not valid');
            }
			

			$this->mobile = sprintf('%s%s%s',$this->intldialcode,$this->areacode,$this->localnumber);
			$this->user->profile->mobile = $this->mobile; 
           
            // validate profile
            $strProfile = "";
            $strProfile = $this->cleanHtml($request->getPost('smeprofile'));
            $this->user->profile->smeprofile = $this->sanitize($strProfile);
			
			if (strlen($this->user->profile->smeprofile) < 400){
				$this->addError('smeprofile', 'Please enter your profile information.');			
			}
			
            // if no errors have occurred, save the user
            if (!$this->hasError()) {
            	$this->user->profile->status = $this->status;
                $this->user->save();

            }
            // return true if no errors have occurred
            return !$this->hasError();
        }
    }
?>