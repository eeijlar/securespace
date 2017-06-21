<?php /* Smarty version 2.6.18, created on 2009-03-16 14:59:22
         compiled from email/user-reject.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'email/user-reject.tpl', 1, false),)), $this); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - Your Application
Dear <?php echo $this->_tpl_vars['user']->profile->first_name; ?>
,

Unfortunately, due to your particular case we cannot work with you on this occasion.


Sincerely,

<?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 Administration Team