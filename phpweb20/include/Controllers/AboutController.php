<?php
   class AboutController extends CustomControllerAction
    {
        public function indexAction() {
            $sessionCost = Zend_Registry::get('config')->session->cost;   
            $this->view->rate = $sessionCost;
        }
    }
?>
