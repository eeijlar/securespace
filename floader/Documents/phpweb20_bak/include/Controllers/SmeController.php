<?php

class smeController extends CustomControllerAction {
		
        public function viewAction(){
        	
        	$index=0;
            $request = $this->getRequest();
            
           if ($request->isPost()) {
	              $this->_redirect('/account/register');
        	
        	}  else {
        		$sme_ids = array();
        		$smes = array();
        		
        		$user = new DatabaseObject_User($this->db);
        		$sme_ids = $user->fetchSmeUserIds();
        		
        		foreach ($sme_ids as $value) {
				 	$profile = new Profile_User($this->db,$value);
				 	$profile->load();
				 	$smes[$index]['user_id'] = $value;
				 	$smes[$index]['name'] =  trim($profile->first_name. ' ' .$profile->last_name);
				 	$smes[$index]['smeprofile'] = trim($profile->smeprofile);
				 	$smes[$index]['status'] = trim($profile->status);
				 	$index++;
				 }
        		
        		$this->view->smes = $smes;	
        	}      
        }

        public function processAction(){
        	$this->identity = Zend_Auth::getInstance()->getIdentity();
         	$user_id = trim($this->getRequest()->getQuery('id'));
         	$action = trim($this->getRequest()->getQuery('action'));   
			$this->identity->action = $action;

			$nc = new ClientProcessor_NewClients($this->db,$user_id); 
			
			if ($action == "accept") {
				
				if (!$nc->sendEmail('user-cert.tpl',$action)){
					$this->_redirect('/sme/processfailed');
				}
				
				$nc->sendTextMessage('user-text.tpl');
				$nc->updateStatus($action);	
				$this->_redirect('/sme/processcomplete');
					
			} else {
				$nc->sendEmail('user-reject.tpl',$action);
				$nc->updateStatus($action);
				$this->_redirect('/sme/processcomplete');					
			}
         	      
        }

        public function processcompleteAction(){
        	$this->identity = Zend_Auth::getInstance()->getIdentity();
        	
			$this->view->name = $this->identity->current_client;			
			
			$this->view->action = $this->identity->action;
         	      
        }
 
         public function processfailedAction(){
        	$this->identity = Zend_Auth::getInstance()->getIdentity();			
	
			$this->view->name = $this->identity->current_client;			
			$this->view->action = $this->identity->action;		
			$this->view->error = $this->identity->error;
         	      
        }
               
        public function clientsAction(){
			 $index = 0;
			 $clients[] = null;
			 $this->identity = Zend_Auth::getInstance()->getIdentity();
			
			 foreach ($this->identity->clients as $value) {
			 	$profile = new Profile_User($this->db,$value);
			 	$profile->load();
			 	$clients[$index]['user_id'] = $value;
			 	$clients[$index]['name'] =  trim($profile->first_name. ' ' .$profile->last_name);
			 	$clients[$index]['story'] = trim($profile->story);
			 	$clients[$index]['status'] = trim($profile->status);
			 	$index++;
			 }

			 $this->view->clients=$clients;
			
        }                      
}
?>