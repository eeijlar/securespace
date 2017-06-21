<?php
    class ImportController extends CustomControllerAction
    {
        public function indexAction(){ 
        	
         
        }

        public function firefoxAction(){
        	       	 
        	$siteName = Zend_Registry::get('config')->website->name;
        	$siteUrl = Zend_Registry::get('config')->website->url;
        	$siteSupport = Zend_Registry::get('config')->email->support;
        	$siteFeedback = Zend_Registry::get('config')->email->feedback;
        	$this->view->support = $siteSupport;
        	$this->view->feedback = $siteFeedback;
        	$this->view->url=$siteUrl;
        	$this->view->sitename = $siteName;
        }

        public function ieAction(){
        	       	 
        	$siteName = Zend_Registry::get('config')->website->name;
        	$siteUrl = Zend_Registry::get('config')->website->url;
        	$siteSupport = Zend_Registry::get('config')->email->support;
        	$siteFeedback = Zend_Registry::get('config')->email->feedback;
        	$this->view->support = $siteSupport;
        	$this->view->feedback = $siteFeedback;
        	$this->view->url=$siteUrl;
        	$this->view->sitename = $siteName;
        }

    }
?>
