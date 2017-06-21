<?php /* Smarty version 2.6.18, created on 2009-04-02 12:14:49
         compiled from admin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.tpl', 2, false),)), $this); ?>
<div>
<label style="float:left;padding-left:12px;">Welcome, <?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->first_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 </label>
</div>
<div class = "mailSpacer"></div>
<div id="navigation">
<ul>
	<li id="inboxSelected"><a href="/account/registersme">Add SME</a></li>
	<li><a href="/admin/pending">Pending Applications</a></li>
</ul>
</div>
<div id="inboxBorder">
</div>