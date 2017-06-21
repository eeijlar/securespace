<?php /* Smarty version 2.6.18, created on 2009-10-06 16:28:22
         compiled from email/user-mail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'email/user-mail.tpl', 4, false),)), $this); ?>
<?php echo $this->_tpl_vars['user']->profile->first_name; ?>
, You have a new message... 
Dear <?php echo $this->_tpl_vars['user']->profile->first_name; ?>
,

You have been sent a message on <?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
.

To view the message chose the option "login" or follow the link: <?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/account/login

Yours sincerely,

<?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 Administration