<?php /* Smarty version 2.6.18, created on 2008-10-16 02:30:17
         compiled from client_header.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Secure Counselling</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
	<link rel="stylesheet" type="text/css" href="/css/styles.css" media="all"/>
	<script type ="text/javascript" src="/js/prototype.js"></script>
	<script type ="text/javascript" src="/js/scriptaculous/scriptaculous.js"></script>
	<script type="text/javascript" src="/js/CheckRegistrationForm.js"></script>	
	</head>
	<body  onload="updateCountryPhoneCodeOnChangeInit();">
 <div id="wrap">
  	<div id="header">&nbsp;&nbsp;&nbsp; Secure Counselling</div>
  		<div id="content">
    		<div id="column1">
		      <div id="nav">
		          <?php if ($this->_tpl_vars['authenticated']): ?>
		          <?php else: ?>
			        <ul>
			          <li><a href="/index" accesskey="a">Home</a></li>			
			          <li><a href="/index">What is Online Counselling? </a></li>
			          <li><a href="/sme/view" accesskey="r"><strong>Register</strong></a></li>
			          <li><a href="/index" accesskey="r">Our Services </a></li>
		              <li><a href="/index" accesskey="1">Online Counselling</a></li>
		              <li><a href="/index" accesskey="2">Counsellor Training</a></li>
		              <li><a href="/index" accesskey="3">Consultancy</a></li>
		              <li><a href="/index" accesskey="3">Technical Solutions</a></li>
				      <li><a href="/account/login" accesskey="r"><strong>Log in for Counselling</strong></a><a href="/index" accesskey="r">Contact Us</a></li>         
		        	</ul>
		        <?php endif; ?>  
		      </div>
    		</div>
			<div id="column2" style="border-left: 1px solid #C3C3C3;">

            