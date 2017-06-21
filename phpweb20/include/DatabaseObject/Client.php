<?php
    class DatabaseObject_Client extends DatabaseObject {
    	public $index = 0;

        public function __construct($db)
        {
            parent::__construct($db, 'users_profile', 'user_id');

            $this->add('profile_key');
            $this->add('profile_value');
        }
        
        public function getClientIds($sme){
        	$clients[] =null;
		$user_ids[] =null;
        	$query = sprintf('select %s from %s where profile_value = "%s"', 
        						join(', ', $this->getSelectFields()),
        						$this->_table,
        						$sme);
	
        	$clients =  $this->_db->fetchAll($query);
      		if(sizeof($clients) !=0){
			 foreach($clients as $value){
			 	$user_ids[$this->index] = $clients[$this->index]['user_id'];
			 	$this->index++;
			 }	
		}	 			 		
		return $user_ids;				 
        }        

        public function getSmeId($sme){
        	
        	preg_match('/(\w+)(\s)(\w+)/',$sme,$captured);
        	
        	$first_name = $captured[1];
        	$last_name = $captured[3];
        	
        	$query = sprintf('select %s from %s where profile_value = "%s"', 
        						join(', ', $this->getSelectFields()),
        						$this->_table,
        						$first_name);
        	
 
        	$first_name_id =  $this->_db->fetchOne($query);
        	
        	$query = sprintf('select %s from %s where profile_value = "%s"', 
        						join(', ', $this->getSelectFields()),
        						$this->_table,
        						$last_name);
        						 
        	$last_name_id = $this->_db->fetchOne($query);
        	
        	if($first_name_id == $last_name_id) {
				return $first_name_id;       		
        		
        	} else {
        		return 0;        		
        	}
        }        
        
    }  
?>
