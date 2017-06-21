<?php
    class Profile_Inbox extends Profile
    {
        public function __construct($db, $message_id = null)
        {
            parent::__construct($db, 'messages_profile');

            if ($message_id > 0)
                $this->setMessageId($message_id);
        }

        public function setMessageId($message_id)
        {
            $filters = array('message_id' => (int) $message_id);
            $this->_filters = $filters;
        }
    }
?>