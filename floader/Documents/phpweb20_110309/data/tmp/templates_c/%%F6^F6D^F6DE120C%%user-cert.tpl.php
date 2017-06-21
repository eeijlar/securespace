<?php /* Smarty version 2.6.18, created on 2008-10-19 12:12:23
         compiled from email/user-cert.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'email/user-cert.tpl', 1, false),)), $this); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - Registration Complete
Dear <?php echo $this->_tpl_vars['user']->profile->first_name; ?>
,

Your registration with <?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 is now complete. In this e-mail you will find an attachment 
with your digital certificate. This certificate will allow you to access the secure area of the site.

You should also have received a text message with your digital certificate password. You will need 
this password to import the attached certificate into your web browser. 

Before you can log in you need to import the certificate into your browser:

If you have an Internet Explorer web browser, please visit this link to get detailed installation instructions:
<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/import/ie

If you have Mozilla Firefox, please visit this link for instructions:
<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/import/firefox



Sincerely,

<?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 Administration Team