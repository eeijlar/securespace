<?php /* Smarty version 2.6.18, created on 2008-10-19 12:44:26
         compiled from sme_header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'sme_header.tpl', 31, false),array('modifier', 'escape', 'sme_header.tpl', 31, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Secure Space</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
	<link rel="stylesheet" type="text/css" href="/css/styles.css" media="all"/>
	<script type ="text/javascript" src="/js/prototype.js"></script>
	<script type="text/javascript" src="/js/updatesession.js"></script>
	<script type="text/javascript" src="/js/CheckRegistrationForm.js"></script>	
	<script type ="text/javascript" src="/js/scriptaculous/scriptaculous.js"></script>
	</head>
	<body onload="updateCountryPhoneCodeOnChangeInit();">
 <div id="wrap">
  <!-- start of container -->
  <div id="header">&nbsp;&nbsp;&nbsp; Secure Counselling</div>
  <div id="content">
    <!-- left column, contains navigation and photos -->
 
    <!-- end of left column -->
    <!-- right column, this is the main content area, and where the links are -->
    <div id="column5">
            <?php if ($this->_tpl_vars['authenticated']): ?>
             <h4>Secure Counselling</h4>
             	<div>&nbsp;</div>
                <label style="float:left">| <a href="/account">Your Account</a>
                 | <a href="/profile/view">Profile</a>
                 </label>
                <?php if ($this->_tpl_vars['identity']->user_type == 'administrator'): ?>
                <label style="float:left">| <a href="/admin">Administration</a></label>
                <label style="float:right">Status: <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['identity']->user_type)) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <?php else: ?>
                <div>&nbsp;</div>   
                <div>&nbsp;</div>        
                <?php endif; ?>
                
            <?php else: ?>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['authenticated']): ?>
                    <label style="float:right">Logged in as <?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->first_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->last_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    (<a href="/account/logout">logout</a>)</label>
            <?php endif; ?>