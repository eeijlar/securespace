<?php /* Smarty version 2.6.18, created on 2009-10-06 13:04:37
         compiled from email/sme-register.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'email/sme-register.tpl', 4, false),)), $this); ?>
<?php echo $this->_tpl_vars['user']->profile->first_name; ?>
, Thank You For Your Registration
Dear <?php echo $this->_tpl_vars['user']->profile->first_name; ?>
,

You have now registered as a therapist with <?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
. Your username and password for your account are:

    Username: <?php echo $this->_tpl_vars['user']->username; ?>

    Password: <?php echo $this->_tpl_vars['user']->_newPassword; ?>


To log on choose the option "login" or follow the link: <?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/account/login


Yours sincerely,

<?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 Administration