<?php
    class FormProcessor_SmeProfile extends FormProcessor
    {

        public function __construct($db, $user_id)
        {
            parent::__construct();
            $this->db = $db;
            $this->user = new DatabaseObject_User($db);
            $this->user->load($user_id);
  
        }

  		public function process(Zend_Controller_Request_Abstract $request){
  			    
  			$strProfile = $this->cleanHtml($request->getPost('smeprofile'));
  			
  			if(strlen($strProfile) > 5000) {
  				return false;
  			}
  			else {
  				$this->user->profile->smeprofile = $this->sanitize($strProfile);
        		$this->user->profile->save();
        	
        		return true;		
  			}           
  		}			

    }
?>