<?<?php
    class AdminController extends CustomControllerAction
    {
    	public function indexAction(){
    		
    		
    	}
    	
    	public function pendingAction(){
			 $index = 0;
			 $smes[] = null;
			 $this->identity = Zend_Auth::getInstance()->getIdentity();
			
			 foreach ($this->identity->sme_list as $value) {
			 	$profile = new Profile_User($this->db,$value);
			 	$profile->load();
			 	$smes[$index]['user_id'] = $value;
			 	$smes[$index]['name'] =  trim($profile->first_name. ' ' .$profile->last_name);
			 	$smes[$index]['status'] = trim($profile->status);
			 	$index++;
			 }

			 $this->view->smes=$smes;
			
           
    	}
    
    }
?>