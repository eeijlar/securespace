<?php /* Smarty version 2.6.18, created on 2008-10-16 03:18:16
         compiled from email/user-fetch-password.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'email/user-fetch-password.tpl', 8, false),)), $this); ?>
<?php echo $this->_tpl_vars['user']->profile->first_name; ?>
, Your Account Password
Dear <?php echo $this->_tpl_vars['user']->profile->first_name; ?>
,

You recently requested a password reset as you had forgotten your password.

Your new password is listed below. To activate this password, click this link:

    Activate Password: <?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/account/fetchpassword?action=confirm&id=<?php echo $this->_tpl_vars['user']->getId(); ?>
&key=<?php echo $this->_tpl_vars['user']->profile->new_password_key; ?>

    Username: <?php echo $this->_tpl_vars['user']->username; ?>

    New Password: <?php echo $this->_tpl_vars['user']->_newPassword; ?>


If you didn't request a password reset, please ignore this message and your password
will remain unchanged.

Sincerely,

<?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 Administration Team