<?php
    class DatabaseObject_Mail extends DatabaseObject
    {
        public $profile = null;
        
        const STATUS_NEW = 'New';
        const STATUS_READ  = 'Read';

		// FIX LATER **************************

        public function __construct($db)
        {
            parent::__construct($db, 'messages', 'message_id');

            $this->add('from_id');
            $this->add('to_id');
            $this->add('message_status', self::STATUS_NEW);
            $this->add('ts_created');

            $this->profile = new Profile_Inbox($db);
        }
        
        protected function postLoad()
        {
            $this->profile->setMessageId($this->getId());
            $this->profile->load();
        }

        protected function postInsert()
        { 
            $this->profile->setMessageId($this->getId());
            $this->profile->save(false); 
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

        public function loadInbox($user_id)
        {
            $user_id = (int) $user_id;

            if ($user_id <= 0)
                return false;

            $query = sprintf(
                'select %s from %s where user_id = %d',
                join(', ', $this->getSelectFields()),
                $this->_table,
                $user_id
            );
		
        }
        
        public function loadForUser($user_id, $message_id)
        {
            $message_id = (int) $message_id;
            $user_id = (int) $user_id;

            if ($message_id <= 0 || $user_id <= 0)
                return false;
         
            $query = sprintf(
                'select * from %s where from_id = %d and message_id = %d',
                $this->_table,
                $user_id,
                $message_id
            );

            return $this->_load($query);
        }
 
       public static function GetMessages($db, $options = array())
        {       	
            $defaults = array(
                'order' => 'p.ts_created'
            );

            foreach ($defaults as $k => $v) {
                $options[$k] = array_key_exists($k, $options) ? $options[$k] : $v;
            }
	    	
            $select = self::_GetBaseQuery($db, $options);

            // set the fields to select
            $select->from(null, 'p.*');

            // order the results
            $select->order($options['order']);

            // fetch post data from database
            $data = $db->fetchAll($select);

            // turn data into array of DatabaseObject_Inbox objects
            $messages = self::BuildMultiple($db, __CLASS__, $data);
            $message_ids = array_keys($messages);
            if (count($message_ids) == 0)
                return array();

            // load the profile data for loaded posts
            $profiles = Profile::BuildMultiple(
                $db,
                'Profile_Inbox',
                array('message_id' => $message_ids)
            );
        

            foreach ($messages as $message_id => $message) {
                if (array_key_exists($message_id, $profiles)
                        && $profiles[$message_id] instanceof Profile_Inbox) {

                    $messages[$message_id]->profile = $profiles[$message_id];
                }
                else {
                    $messages[$message_id]->profile->setMessageId($message_id);
                }
            }

            return $messages;	 

	}   	
	    	
       	private static function _GetBaseQuery($db, $options)
        {         	
            // initialize the options
            $defaults = array(
                'from_id' => array(),
                'to_id' => array(),
                'message_status' => ''
            );

            foreach ($defaults as $k => $v) {
                $options[$k] = array_key_exists($k, $options) ? $options[$k] : $v;
            }

            // create a query that selects from the messages table
            $select = $db->select();
            $select->from(array('p' => 'messages'), array());

            // filter results on specified user ids (if any)
            if (count($options['from_id']) > 0)
                $select->where('p.from_id in (?)', $options['from_id']);

            if (strlen($options['to_id']) > 0)
                $select->where('p.to_id in (?)', $options['to_id']);

            // filter results based on message status
            if (strlen($options['message_status']) > 0)
                $select->where('message_status = ?', $options['message_status']);

            return $select;
        }
         
       	public static function GetMessageCount($db, $options)
        {
            $select = self::_GetBaseQuery($db, $options);
            $select->from(null, 'count(*)');
            
            return $db->fetchOne($select);
        }
 
        public function markAsRead()
        {
            if ($this->message_status == self::STATUS_NEW) {
                $this->message_status = self::STATUS_READ;
            }
        }       
        
        public function send($from)
        {
            if ($this->status != self::STATUS_NEW) {
                $this->status = self::STATUS_NEW;
                 $this->profile->from = $from;

            }
        }            

    }
?>
