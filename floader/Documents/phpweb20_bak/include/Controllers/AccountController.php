<?php
    class AccountController extends CustomControllerAction
    {
        public function init()
        {
            parent::init();
            
            $this->identity = Zend_Auth::getInstance()->getIdentity();
        }

        public function indexAction(){ 
        	
			// send the user type to the template: admin, member etc.
        	$this->view->user_type = $this->identity->user_type; 
        	
        	if ($this->identity->user_type == 'member'){
        		$toId = $this->identity->sme_id;
        	} else {
        		$toId = null;
        	} 
 
       		$newMessages = DatabaseObject_Mail::GetMessageCount(
                $this->db,
                array('from_id' => $toId,
					  'to_id'   => $this->identity->user_id,
					  'message_status' => 'New'                
            ));         
   			 			
            $this->identity->newMessages = $newMessages;
        	$this->view->newMessages = $this->identity->newMessages;  
        	        
        }
        
        public function clientAction(){ 
        	         
        }

        public function registerAction()
        {
            $this->view->website = Zend_Registry::get('config')->website->name;
            $request = $this->getRequest();
            
            $fp = new FormProcessor_UserRegistration($this->db);
            $validate = $request->isXmlHttpRequest();  
            
            
            if($request->isGet() && !$validate){
            	  	$sme_id = $request->getQuery('sme');
		           	// create session to store sme name
		            $session = new Zend_Session_Namespace('sme');                
		            $queryId = $fp->getSME($sme_id);	
		        		                        
		            if($queryId != 'error'){	
		            	$this->view->sme=$queryId;	
		            	$session->sme=$queryId;
                                $session->sme_id = $sme_id;	
		            
		            } else {
		            	$this->view->sme="";	
		            	$session->sme="";
		            }
            }            
            
            if ($request->isPost()) {
            		if ($validate){
            			$fp->validateOnly(true);
            			$fp->process($request);
	            	}
	                else if ($fp->process($request)) {
	                    $session = new Zend_Session_Namespace('registration');
	                    $session->user_id = $fp->user->getId();
	                    $this->_redirect('/account/registercomplete');
	                }          	
            } 
            

            
            if ($validate) {
                $json = array(
                    'errors' => $fp->getErrors()
                );
                $this->sendJson($json);
            }
            else {
                $this->view->fp = $fp;
            }
        }
 
        public function registersmeAction()
        {
            $request = $this->getRequest();

            $fp = new FormProcessor_SmeRegistration($this->db);          
        	
            if ($request->isPost()) {
                if ($fp->process($request)) {
                    $session = new Zend_Session_Namespace('registration');
                    $session->user_id = $fp->user->getId();
                    
                    $this->_redirect('/account/registercompletesme');
                }
            }

            $this->view->fp = $fp;
        }       

        public function registercompleteAction()
        {
            // retrieve the same session namespace used in register
            $session = new Zend_Session_Namespace('registration');
            
            // update the stored list of clients
            $this->identity->clients[] = $session->user_id;

            // load the user record based on the stored user ID
            $user = new DatabaseObject_User($this->db);
            if (!$user->load($session->user_id)) {
                $this->_forward('register');
                return;
            }

            $this->view->user = $user;
        }

        public function helpAction()
        {

        }  

        public function registercompletesmeAction()
        {
            // retrieve the same session namespace used in register
            $session = new Zend_Session_Namespace('registration');
            
            // update the stored list of identities
        	$this->identity->sme_list[] = $session->user_id;

            // load the user record based on the stored user ID
            $user = new DatabaseObject_User($this->db);
            if (!$user->load($session->user_id)) {
                $this->_forward('register');
                return;
            }

            $this->view->user = $user;
        }        

        public function loginAction()
        {
        	$blnCertMatch = true;
            // if a user's already logged in, send them to their account home page
            $auth = Zend_Auth::getInstance();

            if ($auth->hasIdentity())
                $this->_redirect('/account');

            $request = $this->getRequest();

            // initialize errors
            $errors = array();

            // process login if request method is post
            if ($request->isPost()) {

                // fetch login details from form and validate them
                $username = $request->getPost('username');
                $password = $request->getPost('password');

                if (strlen($username) == 0)
                    $errors['username'] = 'Required field must not be blank';
                if (strlen($password) == 0)
                    $errors['password'] = 'Required field must not be blank';

                if (count($errors) == 0) {

                    // setup the authentication adapter
                    $adapter = new Zend_Auth_Adapter_DbTable($this->db,
                                                             'users',
                                                             'username',
                                                             'password',
                                                             'md5(?)');

                    $adapter->setIdentity($username);
                    $adapter->setCredential($password);

                    // try and authenticate the user
                    $result = $auth->authenticate($adapter);					

                    if ($result->isValid()) {
                        $user = new DatabaseObject_User($this->db);
                        $user->load($adapter->getResultRowObject()->user_id);                                                                            					
						
						// verify that user matches certificate
						$strName = strtoupper(trim($user->getFirstName(). ' ' .$user->getLastName()));
		           		$strClientCert = strtoupper($_SERVER['SSL_CLIENT_S_DN_CN']);
                        
                        if ($strName != $strClientCert){
                        	$blnCertMatch = false;
                        	$errors['certificate'] = 'User name entered does not match name on registered client certificate.';
                        }
                        else {     	
                        	// record login attempt
			                $user->loginSuccess();
			
			                // create identity data and write it to session
			                $identity = $user->createAuthIdentity();
			                $auth->getStorage()->write($identity);
							
							$this->_redirect('/account');
							
                        }
                    }

                    // record failed login attempt
                    DatabaseObject_User::LoginFailure($username,
                                                      $result->getCode());
                    if ($blnCertMatch) {
                    	$errors['username'] = 'Your login details were invalid';
                    }       
                }
            }

            $this->view->errors = $errors;
        }

        public function logoutAction()
        {
            Zend_Auth::getInstance()->clearIdentity();
            $this->_redirect('/');
        }

        public function fetchpasswordAction()
        {
            // if a user's already logged in, send them to their account home page
            if (Zend_Auth::getInstance()->hasIdentity())
                $this->_redirect('/account');

            $errors = array();

            $action = $this->getRequest()->getQuery('action');

            if ($this->getRequest()->isPost())
                $action = 'submit';

            switch ($action) {
                case 'submit':
                    $username = trim($this->getRequest()->getPost('username'));
                    if (strlen($username) == 0) {
                        $errors['username'] = 'Required field must not be blank';
                    }
                    else {
                        $user = new DatabaseObject_User($this->db);
                        if ($user->load($username, 'username')) {
                            $user->fetchPassword();
                            $url = '/account/fetchpassword?action=complete';
                            $this->_redirect($url);
                        }
                        else
                            $errors['username'] = 'Specified user not found';
                    }
                    break;

                case 'complete':
                    // nothing to do
                    break;

                case 'confirm':
                    $id = $this->getRequest()->getQuery('id');
                    $key = $this->getRequest()->getQuery('key');

                    $user = new DatabaseObject_User($this->db);
                    if (!$user->load($id))
                        $errors['confirm'] = 'Error confirming new password';
                    else if (!$user->confirmNewPassword($key))
                        $errors['confirm'] = 'Error confirming new password';

                    break;
            }

            $this->view->errors = $errors;
            $this->view->action = $action;
        }

        public function detailsAction()
        {
        	$this->identity = Zend_Auth::getInstance()->getIdentity();
			// send the user type to the template: admin, member etc.
 
        	$this->view->user_type = $this->identity->user_type;
        	
            $auth = Zend_Auth::getInstance();

            $fp = new FormProcessor_UserDetails($this->db,
                                                $auth->getIdentity()->user_id);

            if ($this->getRequest()->isPost()) {
                if ($fp->process($this->getRequest())) {
                    $auth->getStorage()->write($fp->user->createAuthIdentity());
                    $this->_redirect('/account/detailscomplete');
                }
            }

            $this->view->fp = $fp;
        }

        public function detailscompleteAction()
        {
            $user = new DatabaseObject_User($this->db);
            $this->identity = Zend_Auth::getInstance()->getIdentity();
            $user->load(Zend_Auth::getInstance()->getIdentity()->user_id);

            $this->view->user = $user;          
			// send the user type to the template: admin, member etc.
 
        	$this->view->user_type = $this->identity->user_type;
        }
    }
?>