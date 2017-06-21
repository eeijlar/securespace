<?php
    class CustomControllerAclManager extends Zend_Controller_Plugin_Abstract
    {
        // default user role if not logged or (or invalid role found)
        private $_defaultRole = 'guest';

        // the action to dispatch if a user doesn't have sufficient privileges
        private $_authController = array('controller' => 'account',
                                         'action' => 'login');

        public function __construct(Zend_Auth $auth)
        {
            $this->auth = $auth;
            $this->acl = new Zend_Acl();

            // add the different user roles
            $this->acl->addRole(new Zend_Acl_Role($this->_defaultRole));
            $this->acl->addRole(new Zend_Acl_Role('member'));
            $this->acl->addRole(new Zend_Acl_Role('inactive'));
            $this->acl->addRole(new Zend_Acl_Role('sme'));
            $this->acl->addRole(new Zend_Acl_Role('superuser'));
            $this->acl->addRole(new Zend_Acl_Role('administrator'), 'member');

            // add the resources we want to have control over
            $this->acl->add(new Zend_Acl_Resource('account'));
            $this->acl->add(new Zend_Acl_Resource('admin'));
            $this->acl->add(new Zend_Acl_Resource('sme'));
            $this->acl->add(new Zend_Acl_Resource('online'));
            $this->acl->add(new Zend_Acl_Resource('index'));
            $this->acl->add(new Zend_Acl_Resource('training'));
            $this->acl->add(new Zend_Acl_Resource('consultancy'));
            $this->acl->add(new Zend_Acl_Resource('about'));
            $this->acl->add(new Zend_Acl_Resource('services'));
            $this->acl->add(new Zend_Acl_Resource('solutions'));
            $this->acl->add(new Zend_Acl_Resource('contact'));
            $this->acl->add(new Zend_Acl_Resource('utility'));
            $this->acl->add(new Zend_Acl_Resource('mail'));
            $this->acl->add(new Zend_Acl_Resource('payment'));

    
            // deny access to everything for all users by default
            $this->acl->deny();

            // add exceptions for public accessible pages 
            $this->acl->allow('guest', 'account', array('login', 'fetchpassword', 'register', 'registercomplete'));
            $this->acl->allow('guest', 'sme', array('view'));
            $this->acl->allow('guest','online');
            $this->acl->allow('guest','index');
            $this->acl->allow('guest','training');
            $this->acl->allow('guest','consultancy');
            $this->acl->allow('guest','about');
            $this->acl->allow('guest','services');
            $this->acl->allow('guest','solutions');
            $this->acl->allow('guest','contact');
            $this->acl->allow('guest','utility');
            

            // allow members access to the account management area
            $this->acl->allow('member', 'account');
            $this->acl->allow('sme', 'account');
            $this->acl->allow('superuser','account');
            $this->acl->allow('inactive','account');

            // allow members access to the mail area
            $this->acl->allow('member','mail');
            $this->acl->allow('superuser','mail');
            $this->acl->allow('sme','mail');
            $this->acl->allow('inactive','mail');

            // allow smes/inactive smes access to the clients area
            $this->acl->allow('sme','sme', array('clients'));
            $this->acl->allow('inactive','sme', array('clients'));            
            

            // allow clients access to the payments area
            $this->acl->allow('member', 'payment');

            // allows administrators access to the admin area
            $this->acl->deny('member', 'admin');
            $this->acl->deny('sme', 'admin');
            $this->acl->deny('inactive', 'admin');
            $this->acl->allow('administrator', 'admin');
            $this->acl->allow('superuser','admin');

            $this->acl->deny('superuser', 'mail', array('newmessage','reply','sent'));
        }

        /**
         * preDispatch
         *
         * Before an action is dispatched, check if the current user
         * has sufficient privileges. If not, dispatch the default
         * action instead
         *
         * @param Zend_Controller_Request_Abstract $request
         */
        public function preDispatch(Zend_Controller_Request_Abstract $request)
        {
            // check if a user is logged in and has a valid role,
            // otherwise, assign them the default role (guest)
            if ($this->auth->hasIdentity())
                $role = $this->auth->getIdentity()->user_type;
            else
                $role = $this->_defaultRole;

            if (!$this->acl->hasRole($role))
                $role = $this->_defaultRole;

            // the ACL resource is the requested controller name
            $resource = $request->controller;

            // the ACL privilege is the requested action name
            $privilege = $request->action;

            // if we haven't explicitly added the resource, check
            // the default global permissions
            if (!$this->acl->has($resource))
                $resource = null;

            // access denied - reroute the request to the default action handler
            if (!$this->acl->isAllowed($role, $resource, $privilege)) {
                $request->setControllerName($this->_authController['controller']);
                $request->setActionName($this->_authController['action']);
            }
        }
    }
?>
