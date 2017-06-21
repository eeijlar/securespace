<?php
    class PaymentProcessor_UserPayment
    {
        protected $db = null;
        public $user = null;
        public $message = null;
        public $oremarks = null;
        public $txDetails = null;


        public function __construct($db, $user_id)
        {
            $this->db = $db;

            $this->user = new DatabaseObject_User($db);
            $this->user->load($user_id);
            
            $this->payment = new DatabaseObject_Payments($db);                           
            $this->identity = Zend_Auth::getInstance()->getIdentity();    
        }

        public function process($transaction)    {
        	
        	$logger = Zend_Registry::get('logger');
        	
        	$mailUserName = Zend_Registry::get('config')->paypal->email;
			$at = Zend_Registry::get('config')->paypal->token; 
			$url = Zend_Registry::get('config')->paypal->url; 					
			$cmd = Zend_Registry::get('config')->paypal->notify;			 
			$post = "tx=$transaction&at=$at&cmd=$cmd";


			//Send request to PayPal server using CURL
			$ch = curl_init ($url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_HEADER, 0);
			curl_setopt ($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);

			//returned result is key-value pair string
			
			$result = curl_exec ($ch); 
			$error = curl_error($ch);

				if (curl_errno($ch) != 0) {
						$logger->notice("Curl error");
        		}

			$longstr = str_replace("\r", "", $result);
			$lines = split("\n", $longstr);
			$logger->notice($lines[0]);

			//parse the result string and store information to array			
				if ($lines[0] == "SUCCESS") {
					//successful payment
					$ppInfo = array();
				
					for ($i=1; $i<count($lines); $i++) {
						$parts = split("=", $lines[$i]);
					
						if (count($parts)==2) {
							$ppInfo[$parts[0]] = urldecode($parts[1]);
						}
					}
					
				} else {
					return false;
				}
				$curtime = gmdate("d/m/Y H:i:s");

				//capture the PayPal returned information as order remarks
				$this->oremarks =
				"##$curtime##\n".
				"PayPal Transaction Information...\n".
				"Txn Id: ".$ppInfo["txn_id"]."\n".
				"Txn Type: ".$ppInfo["txn_type"]."\n".
				"Item Number: ".$ppInfo["item_number"]."\n".
				"Payment Date: ".$ppInfo["payment_date"]."\n".
				"Payment Type: ".$ppInfo["payment_type"]."\n".
				"Payment Status: ".$ppInfo["payment_status"]."\n".
				"Currency: ".$ppInfo["mc_currency"]."\n".
				"Payment Gross: ".$ppInfo["payment_gross"]."\n".
				"Payment Fee: ".$ppInfo["payment_fee"]."\n".
				"Payer Email: ".$ppInfo["payer_email"]."\n".
				"Payer Id: ".$ppInfo["payer_id"]."\n".
				"Payer Name: ".$ppInfo["first_name"]." ".$ppInfo["last_name"]."\n".
				"Payer Status: ".$ppInfo["payer_status"]."\n".
				"Country: ".$ppInfo["residence_country"]."\n".
				"Business: ".$ppInfo["business"]."\n".
				"Receiver Email: ".$ppInfo["receiver_email"]."\n".
				"Receiver Id: ".$ppInfo["receiver_id"]."\n";

                                $this->txDetails = 
                                "Payment Date: ".$ppInfo["payment_date"]."\n".
                                "Payment Type: ".$ppInfo["payment_type"]."\n".
                                "Payment Status: ".$ppInfo["payment_status"]."\n".
                                "Currency: ".$ppInfo["mc_currency"]."\n". 
                                "Payer Name: ".$ppInfo["first_name"]." ".$ppInfo["last_name"]."\n".
                                "Payer Email: ".$ppInfo["payer_email"]."\n".
                                "Payer Id: ".$ppInfo["payer_id"]."\n";  
				
					if (!$this->payment->checkTxIdExists($ppInfo["txn_id"])) {
						$this->payment->user_id = $this->user->getId();
						$this->payment->firstname = $ppInfo["first_name"];
						$this->payment->lastname = $ppInfo["last_name"];
						$this->payment->payer_email = $ppInfo["payer_email"];
						$this->payment->payer_status = $ppInfo["payer_status"];
						$this->payment->payer_id = $ppInfo["payer_id"];
						$this->payment->itemnumber = $ppInfo["item_number"];			
						$this->payment->txnid = $ppInfo["txn_id"];
						$this->payment->txntype = $ppInfo["txn_type"];
						$this->payment->paymentdate = $ppInfo["payment_date"];
						$this->payment->paymenttype = $ppInfo["payment_type"];
						$this->payment->paymentstatus = $ppInfo["payment_status"];
						$this->payment->country = $ppInfo["residence_country"];
						$this->payment->mc_currency = $ppInfo["mc_currency"];
						$this->payment->business = $ppInfo["business"];
						$this->payment->receiver_email = $ppInfo["receiver_email"];
						$this->payment->receiver_id = $ppInfo["receiver_id"];
						$this->payment->save();
						
						$logger->notice($this->oremarks);
						
						return true;
						//Update database using $orderno, set status to Paid
						//Send confirmation email to buyer and notification email to merchant
						//Redirect to thankyou page
					}				
				
					else {
						return false;
						$logger->notice("Failed");
						$logger->notice($this->oremarks);
					}         	          
  
        }
        
        public function incrementCredits($totalPayment)
        {  	
        	$sessionCost = Zend_Registry::get('config')->session->cost;
        	$credits = $this->user->profile->credits;
        	$credits = (integer) trim($credits);
        	
        	$credits = $credits + ($totalPayment/$sessionCost); 			    		
        	$this->user->profile->credits = (string)$credits;
        	$this->identity->credits = (string) $credits;
        	$this->user->profile->save(); 
        	return true;
        } 
 
      	public function sendEmail($tpl)
        {
            $templater = new Templater();
            $templater->user = $this->user;
            $templater->website = Zend_Registry::get('config')->website->name;
            $templater->url = Zend_Registry::get('config')->website->url;            

            // fetch the e-mail body
            $body = $templater->render('email/' . $tpl);

            // extract the subject from the first line
            list($subject, $body) = preg_split('/\r|\n/', $body, 2);

			$body .= "\n\n".$this->txDetails;
            try {
            // now set up and send the e-mail
            $mail = new Zend_Mail();
            
            // set the to address and the user's full name in the 'to' line
            $mail->addTo($this->user->profile->email,
                         trim($this->user->profile->first_name . ' ' .
                              $this->user->profile->last_name));                 

            // get the admin 'from' details from the config
            $mail->setFrom(Zend_Registry::get('config')->email->from->email,
            Zend_Registry::get('config')->email->from->name);

            // set the subject and body and send the mail
            $mail->setSubject(trim($subject));
            $mail->setBodyText(trim($body));
            $mail->send();
            
                } catch (Zend_Exception $e) {
        		echo $e->getMessage(); exit;
        	}	
        }       
        
    }
?>
