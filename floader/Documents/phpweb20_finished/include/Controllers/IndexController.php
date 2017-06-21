<?php
    class IndexController extends CustomControllerAction
    {
        public function indexAction()
        {
 			$auth = Zend_Auth::getInstance();
				if ($auth->hasIdentity()) {
					 $this->_redirect('/account');			
				}
        	
        }
    }
?>
