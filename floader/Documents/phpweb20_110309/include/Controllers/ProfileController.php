<?<?php
    class ProfileController extends CustomControllerAction
    {
        public function init()
        {
            parent::init();
            $this->identity = Zend_Auth::getInstance()->getIdentity();
        }

        public function indexAction(){ 
          
        }

        public function viewAction(){
        	$this->view->user_type = $this->identity->user_type;
        	$this->view->user_id = $this->identity->user_id;

        }

        public function updatecompleteAction(){

        }

        public function updatefailedAction(){


        }
        
        public function updateAction(){
        	
        	$request = $this->getRequest();
        	
        	if ($request->isPost()) {
        		$fp = new FormProcessor_SmeProfile($this->db,$this->identity->user_id);
        		
        		if ($fp->process($request)) {
                   $this->_redirect('/profile/updatecomplete');
                } else {
                   $this->_redirect('/profile/updatefailed');	
                }
               	
        	}
        	
        	else {
        		$this->user = new DatabaseObject_User($this->db);
        		$this->user->load($this->identity->user_id);
        		$this->view->smeprofile = $this->user->profile->smeprofile;
        	}

        }
        
        public function uploadAction(){
        
        	$request = $this->getRequest();
			$this->view->user_id = $this->identity->user_id;
    	
        	
        	if ($request->getPost('upload')) {
        		$fp = new FormProcessor_SmeImage($this->db,$this->identity->user_id);
        		$this->view->alt = $fp->getAltTitle();  
        		if($fp->process($request)){
        			$this->view->message = "Image successfully uploaded. This image will now be displayed on the 'Select Therapist' page.";
        		}
        		else {
        			foreach($fp->getErrors() as $error)
        				//$this->messenger->addMessage($error);
        				$this->view->message = "Error:".$error;
        		}		
        		
        	}
			  				
        }       
    }
?>