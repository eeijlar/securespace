<?php /* Smarty version 2.6.18, created on 2009-10-07 13:06:17
         compiled from login_header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'login_header.tpl', 35, false),array('modifier', 'escape', 'login_header.tpl', 35, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Secure Counselling Online</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
	<link rel="stylesheet" type="text/css" href="/css/login.css" media="all"/>
	<script type ="text/javascript" src="/js/prototype.js"></script>
	<script type="text/javascript" src="/js/updatesession.js"></script>	
	<script type ="text/javascript" src="/js/scriptaculous/scriptaculous.js"></script>
	</head>
	<body>
 <div id="wrap">
  <!-- start of container -->
  <div id="mastHead" onmouseover="this.style.cursor='pointer';" onclick="window.location.href='http://www.securecounselling.ie'">&nbsp;</div>
    <!-- left column, contains navigation and photos -->
 
    <!-- end of left column -->
    <!-- right column, this is the main content area, and where the links are -->
    <div id="content">
    <div id="column5">
            <?php if ($this->_tpl_vars['authenticated']): ?>
                <label style="float:left;">| <a style="text-decoration:underline; font-weight:bold;" href="/account">Your Account</a>
                 
                     <?php if ($this->_tpl_vars['identity']->user_type == 'administrator' || $this->_tpl_vars['identity']->user_type == 'superuser'): ?>
                          | <a style="text-decoration:underline; font-weight:bold;" href="/profile/view">Profile</a>
                     <?php else: ?>
                          | <a style="text-decoration:underline; font-weight:bold;" href="/account/details">Profile</a>
                     <?php endif; ?>
                
                </label>
                
                     <?php if ($this->_tpl_vars['identity']->user_type == 'administrator' || $this->_tpl_vars['identity']->user_type == 'superuser'): ?>
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

                    (<a style="text-decoration:underline; font-weight:bold;" href="/account/logout">logout</a>)</label>
            <?php endif; ?>