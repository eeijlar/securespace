<?php
    class FormProcessor_UserDetails extends FormProcessor
    {
        protected $db = null;
        public $user = null;

        public $publicProfile = array(
            'public_first_name' => 'First Name',
            'public_last_name'  => 'Last Name',
            'public_home_phone' => 'Home Phone',
            'public_work_phone' => 'Work Phone',
            'public_email'      => 'Email'
        );

        public function __construct($db, $user_id)
        {
            parent::__construct();

            $this->db = $db;
            $this->user = new DatabaseObject_User($db);
            $this->user->load($user_id);

            $this->email = $this->user->profile->email;
            $this->first_name = $this->user->profile->first_name;
            $this->last_name = $this->user->profile->last_name;

            $this->blog_public = $this->user->profile->blog_public;
            $this->num_posts   = $this->user->profile->num_posts;

            foreach ($this->publicProfile as $key => $label)
                $this->$key = $this->user->profile->$key;
        }

        public function process(Zend_Controller_Request_Abstract $request)
        {
            // validate the user's name

            $this->first_name = $this->sanitize($request->getPost('first_name'));
            if (strlen($this->first_name) == 0)
                $this->addError('first_name', 'Please enter your first name');
            else
                $this->user->profile->first_name = $this->first_name;

            $this->last_name = $this->sanitize($request->getPost('last_name'));
            if (strlen($this->last_name) == 0)
                $this->addError('last_name', 'Please enter your last name');
            else
                $this->user->profile->last_name = $this->last_name;

            // validate the e-mail address
            $this->email = $this->sanitize($request->getPost('email'));
            $validator = new Zend_Validate_EmailAddress();

            if (strlen($this->email) == 0)
                $this->addError('email', 'Please enter your e-mail address');
            else if (!$validator->isValid($this->email))
                $this->addError('email', 'Please enter a valid e-mail address');
            else
                $this->user->profile->email = $this->email;

            // check if a new password has been entered and if so validate it
            $this->password = $this->sanitize($request->getPost('password'));
            $this->password_confirm = $this->sanitize($request->getPost('password_confirm'));

            if (strlen($this->password) > 0 || strlen($this->password_confirm) > 0) {
                if (strlen($this->password) == 0)
                    $this->addError('password', 'Please enter the new password');
                else if (strlen($this->password_confirm) == 0)
                    $this->addError('password_confirm', 'Please confirm your new password');
                else if ($this->password != $this->password_confirm)
                    $this->addError('password_confirm', 'Please retype your password');
                else
                    $this->user->password = $this->password;
            }

            // process the user settings
            $this->blog_public = (bool) $request->getPost('blog_public');
            $this->num_posts   = max(1, (int) $request->getPost('num_posts'));

            $this->user->profile->blog_public = $this->blog_public;
            $this->user->profile->num_posts   = $this->num_posts;

            // process the public profile
            foreach ($this->publicProfile as $key => $label) {
                $this->$key = $this->sanitize($request->getPost($key));
                $this->user->profile->$key = $this->$key;
            }

            // if no errors have occurred, save the user
            if (!$this->hasError()) {
                $this->user->save();
            }

            // return true if no errors have occurred
            return !$this->hasError();
        }
    }
?>