<?php /* Smarty version 2.6.18, created on 2008-10-16 03:15:38
         compiled from disclaimer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'disclaimer.tpl', 3, false),)), $this); ?>
<fieldset>
	<legend><b>Security</b></legend>
	<p>All <?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 communications are encrypted using SSL (Secure Socket Layer) technology. The site uses 256-bit SSL certificates provided by independent CA (Certificate Authority), Thawte. Messages exchanged on the web site are encrypted before storage on our servers.</p>
	<p>&nbsp;</p>
	<p>Online counselling is governed by a
professional code of ethics.&nbsp; Online counsellors do not
communicate your personal information to anyone without your consent. </p>
</fieldset>