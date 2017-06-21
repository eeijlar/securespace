<?php

class smeController extends CustomControllerAction {
           protected $encKey;
           protected $iv;
           protected $bit_check=9;
        
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
				
				//$nc->sendTextMessage('user-text.tpl');
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
                         
                         if ($this->identity == null) {
                            exit();
                         }
		         $this->encKey = Zend_Registry::get('config')->enc->enckey;
                         $this->iv = Zend_Registry::get('config')->enc->iv;	
                                                  

			 foreach ($this->identity->clients as $value) {
                                
				if($value != null){
			 		$profile = new Profile_User($this->db,$value);
			 		$profile->load();
			 		$clients[$index]['user_id'] = $value;
			 		$clients[$index]['name'] =  trim($profile->first_name. ' ' .$profile->last_name);
                                	if ($profile->encrypted == 'no') {
                                  		 $clients[$index]['story'] = trim($profile->story);
					} else {
                                   	$clients[$index]['story'] = $this->decrypt(trim($profile->story),$this->encKey,$this->iv,$this->bit_check);                                }
			 		$clients[$index]['status'] = trim($profile->status);
                                	$clients[$index]['date'] = trim($profile->date);
			 		$index++;
                             	}
			 }

			 $this->view->clients=$clients;
			
        }                      
        
        function decrypt($encrypted_text,$key,$iv,$bit_check){
               $cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
               mcrypt_generic_init($cipher, $key, $iv);
               $decrypted = mdecrypt_generic($cipher,base64_decode($encrypted_text));
               mcrypt_generic_deinit($cipher);
               $last_char=substr($decrypted,-1);

               for($i=0;$i<$bit_check-1; $i++){
                   if(chr($i)==$last_char){
                         $decrypted=substr($decrypted,0,strlen($decrypted)-$i);
                         break;
                    }
                } 
                return $decrypted;
        }
}
?>
