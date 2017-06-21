<?php
    class DatabaseObject_User extends DatabaseObject
    {
        static $userTypes = array('member'        => 'Member',
        						  'sme'           => 'Sme',
                                  'administrator' => 'Administrator');

        public $profile = null;
        public $_newPassword = null;
        public $index = 0;

        public function __construct($db)
        {
            parent::__construct($db, 'users', 'user_id');

            $this->add('username');
            $this->add('password');
            $this->add('user_type', 'member');
            $this->add('ts_created', time(), self::TYPE_TIMESTAMP);
            $this->add('ts_last_login', null, self::TYPE_TIMESTAMP);

            $this->profile = new Profile_User($db);
        }

        protected function preInsert()
        {
            $this->_newPassword = Text_Password::create(8);
            $this->password = $this->_newPassword;
            
		return true;
        }

        protected function postLoad()
        {
            $this->profile->setUserId($this->getId());
            $this->profile->load();
        }

        protected function postInsert()
        {
            $this->profile->setUserId($this->getId());
            $this->profile->save(false);
            
            # send email to client
            $this->sendEmail('user-register.tpl');
            
            # send e-mail to sme informing them of registration
            $session = new Zend_Session_Namespace('sme');
            $this->profile->setUserId($session->sme_id);
            $this->profile->load();
            $this->sendEmail('new-user.tpl');

            return true;
        }

        protected function postUpdate()
        {
            $this->profile->save(false);
            return true;
        }

        protected function preDelete()
        {
           // $this->profile->delete();
            return true;
        }

        public function sendEmail($tpl)
        {
            $templater = new Templater();
            $templater->user = $this;
            $templater->website = Zend_Registry::get('config')->website->name;
            $templater->url = Zend_Registry::get('config')->website->url;

            // fetch the e-mail body
            $body = $templater->render('email/' . $tpl);

            // extract the subject from the first line
            list($subject, $body) = preg_split('/\r|\n/', $body, 2);

            // now set up and send the e-mail
            $mail = new Zend_Mail();

            // set the to address and the user's full name in the 'to' line
            $mail->addTo($this->profile->email,
                         trim($this->profile->first_name . ' ' .
                              $this->profile->last_name));

            // get the admin 'from' details from the config
            $mail->setFrom(Zend_Registry::get('config')->email->from->email,
            Zend_Registry::get('config')->email->from->name);

            // set the subject and body and send the mail
            $mail->setSubject(trim($subject));
            $mail->setBodyText(trim($body));
            $mail->send();
        }


        public function createAuthIdentity()
        {
        	$user_id[]=null;
			$index=0;
            $identity = new stdClass;
            $identity->user_id = $this->getId();
            $identity->username = $this->username;
            $identity->user_type = $this->user_type;
            $identity->first_name = $this->profile->first_name;
            $identity->last_name = $this->profile->last_name;
            $identity->email = $this->profile->email;
            
        
            	if ($identity->user_type == 'administrator' || $identity->user_type == 'sme'){
            		$sme = trim($this->profile->first_name . ' ' . $this->profile->last_name);             
            		$client = new DatabaseObject_Client($this->_db);      
			 		$identity->clients=$client->getClientIds($sme);
			 		
			 		if($identity->user_type == 'administrator') {
			 			$identity->sme_list = $this->fetchSmeUserIds();
			 		}
			 				 		
            	}
            	else {
            		$identity->sme = $this->profile->sme;
            		$client = new DatabaseObject_Client($this->_db);
            		$identity->sme_id = $client->getSmeId($this->profile->sme);            		
            		$identity->credits = $this->profile->credits;
            	}

            return $identity;
        }

        public function loginSuccess()
        {
            $this->ts_last_login = time();
            unset($this->profile->new_password);
            unset($this->profile->new_password_ts);
            unset($this->profile->new_password_key);
            $this->save();

            $message = sprintf('Successful login attempt from %s user %s',
                               $_SERVER['REMOTE_ADDR'],
                               $this->username);

            $logger = Zend_Registry::get('logger');
            $logger->notice($message);
        }
        
        static public function LoginFailure($username, $code = '')
        {
            switch ($code) {
                case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
                    $reason = 'Unknown username';
                    break;
                case Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS:
                    $reason = 'Multiple users found with this username';
                    break;
                case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                    $reason = 'Invalid password';
                    break;
                default:
                    $reason = '';
            }

            $message = sprintf('Failed login attempt from %s user %s',
                               $_SERVER['REMOTE_ADDR'],
                               $username);

            if (strlen($reason) > 0)
                $message .= sprintf(' (%s)', $reason);

            $logger = Zend_Registry::get('logger');
            $logger->warn($message);
        }

        public function fetchPassword()
        {
            if (!$this->isSaved())
                return false;

            // generate new password properties
            $this->_newPassword = Text_Password::create(8);
            $this->profile->new_password = md5($this->_newPassword);
            $this->profile->new_password_ts = time();
            $this->profile->new_password_key = md5(uniqid() .
                                                   $this->getId() .
                                                   $this->_newPassword);

            // save new password to profile and send e-mail
            $this->profile->save();
            $this->sendEmail('user-fetch-password.tpl');

            return true;
        }
        
        public function fetchSmeUserIds()
        {	$user_type = "'sme', 'administrator'";
			$query = sprintf('select %s from %s where user_type in (%s)', 
        						join(', ', $this->getSelectFields()),
        						$this->_table,
        						$user_type);            

			$smes =  $this->_db->fetchAll($query);
			
			foreach($smes as $value){
			 	$user_ids[$this->index] = $smes[$this->index]['user_id'];
			 	$this->index++;
			 }	
			 		
		return $user_ids;	
        }        

        public function confirmNewPassword($key)
        {
            // check that valid password reset data is set
            if (!isset($this->profile->new_password)
                || !isset($this->profile->new_password_ts)
                || !isset($this->profile->new_password_key)) {

                return false;
            }

            // check if the password is being confirm within a day
            if (time() - $this->profile->new_password_ts > 86400)
                return false;

            // check that the key is correct
            if ($this->profile->new_password_key != $key)
                return false;

            // everything is valid, now update the account to use the new password

            // bypass the local setter as new_password is already an md5
            parent::__set('password', $this->profile->new_password);

            unset($this->profile->new_password);
            unset($this->profile->new_password_ts);
            unset($this->profile->new_password_key);

            // finally, save the updated user record and the updated profile
            return $this->save();
        }

        public function usernameExists($username)
        {
            $query = sprintf('select count(*) from %s where username = ?',
                             $this->_table);

            $result = $this->_db->fetchOne($query, $username);

            return $result > 0;
        }

        static public function IsValidUsername($username)
        {
            $validator = new Zend_Validate_Alnum();
            return $validator->isValid($username);
        }
        
        public function getFirstName(){
        	
			return $this->profile->first_name;
        }        

        public function getLastName(){
        	
			return $this->profile->last_name;
        }        

        public function __set($name, $value)
        {
            switch ($name) {
                case 'password':
                    $value = md5($value);
                    break;

                case 'user_type':
                    if (!array_key_exists($value, self::$userTypes))
                        $value = 'member';
                    break;
            }

            return parent::__set($name, $value);
        }
    }
?>