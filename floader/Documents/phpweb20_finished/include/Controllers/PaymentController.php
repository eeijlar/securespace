<?php
    class PaymentController extends CustomControllerAction
    {  
        public function indexAction(){ 
        	        	
			// send the user type to the template: admin, member etc.
        	$this->view->user_type = $this->identity->user_type;   
         
        }
        
        public function returnAction(){   
        	$this->identity = Zend_Auth::getInstance()->getIdentity();
         	$this->view->user_type = $this->identity->user_type; 
         	
         	$status = $this->getRequest()->getQuery('st');
         	$amount = $this->getRequest()->getQuery('amt');
			$token  = $this->getRequest()->getQuery('sig');
			$tx = $this->getRequest()->getQuery('tx');         	

			$pp = new PaymentProcessor_UserPayment($this->db,$this->identity->user_id); 
			
			if ($pp->process($tx)) {
				$pp->incrementCredits($amount);
				$pp->sendEmail('user-payment.tpl');		
				$this->_redirect('/payment/paymentcomplete');
			
			} else {
				$this->_redirect('/payment/paymentfailed');			
			}
         
        }
 
         public function paymentcompleteAction() { 
        	$this->identity = Zend_Auth::getInstance()->getIdentity();
			// send the user type to the template: admin, member etc.
			//$this->view->txDetails = $this->identity->txDetails;
        	$this->view->user_type = $this->identity->user_type; 
        	
			// send the user type to the template: admin, member etc.
        	//$this->view->user_type = $this->identity->user_type; 
        	
        	//$messageId = $this->identity->id;
        	
        	//if ($messageId != '') {
        	//	$this->_redirect("/mail/reply?id=$messageId");
        	//}
        	    
        }   
        
         public function paymentfailedAction() { 
        	$this->identity = Zend_Auth::getInstance()->getIdentity();
			// send the user type to the template: admin, member etc.
        	$this->view->user_type = $this->identity->user_type; 
        	
			// send the user type to the template: admin, member etc.
        	//$this->view->user_type = $this->identity->user_type;   
         
        }           


	}
?>
