<?php /* Smarty version 2.6.18, created on 2008-10-16 02:57:17
         compiled from email/user-register.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'email/user-register.tpl', 6, false),)), $this); ?>
<?php echo $this->_tpl_vars['user']->profile->first_name; ?>
, Thank You For Your Registration
Dear <?php echo $this->_tpl_vars['user']->profile->first_name; ?>
,

Thank you for your registration. Your login details are as follows:

    Login URL: <?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/account/login
    Username: <?php echo $this->_tpl_vars['user']->username; ?>

    Password: <?php echo $this->_tpl_vars['user']->_newPassword; ?>

    
You will not be able to log in until your application has been processed. You
will receive a text message when your application has been processed.

Sincerely,

<?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 Administration Team