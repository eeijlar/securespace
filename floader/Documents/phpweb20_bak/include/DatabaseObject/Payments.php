<?php
    class DatabaseObject_Payments extends DatabaseObject
    {
        public $profile = null;

		// FIX LATER **************************

        public function __construct($db)
        {
           parent::__construct($db, 'paypal_payment_info', 'user_id');

		   $this->add('user_id');	
           $this->add('firstname');
 		   $this->add('lastname');
 		   $this->add('payer_email');
 		   $this->add('itemname');
 		   $this->add('itemnumber');
 		   $this->add('quantity');
		   $this->add('paymentdate');
		   $this->add('paymenttype');
		   $this->add('txnid');        
		   $this->add('paymentstatus');        
		   $this->add('pendingreason');        
		   $this->add('txntype');
		   $this->add('mc_currency');
 		   $this->add('business');	   
		   $this->add('country');		   		           
 		   $this->add('receiver_email');
 		   $this->add('receiver_id');
 		   $this->add('payer_status');		           
        }
        
        protected function postLoad()
        {
            $this->profile->setUserId($this->getId());
            $this->profile->load();
        }

        protected function postInsert()
        { 
            return true;
        }

        protected function postUpdate()
        {
            $this->profile->save(false);
            return true;
        }
      
        protected function preDelete()
        {
            $this->profile->delete();
            return true;
        }

        public function checkTxIdExists($txId)
        {
            $query = sprintf('select count(*) from %s where txnid = ?',
                             $this->_table);

            $result = $this->_db->fetchOne($query, $txId);

            return $result > 0;
        }          

}
?>