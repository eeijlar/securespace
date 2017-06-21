<?php /* Smarty version 2.6.18, created on 2009-03-18 12:52:18
         compiled from admin/pending.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'admin/pending.tpl', 13, false),array('modifier', 'escape', 'admin/pending.tpl', 13, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'login_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content">
	<div id="mainContentWide">
<div id = "spacer">
</div>
<form  action="/sme/process" method="post">
		<?php $_from = $this->_tpl_vars['smes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sme']):
?>
			<div id="mailHeader">		
			<div id="inboxHeader"></div>
			<div id = "regSpacer"></div>
			<label id ="margin"><b>Name</b></label>
		 	<label id ="margin" name="client"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['sme']['name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label>
		 	<div id = "regSpacer"></div>
		 	<label id ="margin"><b>Status</b></label>
		 	<label id ="margin"><?php echo ((is_array($_tmp=$this->_tpl_vars['sme']['status'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label>
		 	<div id = "regSpacer"></div>
		 	<?php if ($this->_tpl_vars['sme']['status'] == 'Processed'): ?>
		 	<div id="navigation">
			<li><a href="/sme/process?id=<?php echo ((is_array($_tmp=$this->_tpl_vars['sme']['user_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&action=accept">Accept</a></li>
			<li><a href="/sme/process?id=<?php echo ((is_array($_tmp=$this->_tpl_vars['sme']['user_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&action=reject">Reject</a></li>
			</div>
			<br>
		 	<?php endif; ?>
		 	</div>
		<?php endforeach; endif; unset($_from); ?>	
		  <div id="mailHeader"></div>
		  <div id="mailFooter"></div>
</form>		  
</div><!--maincontentwide-->
</div><!--content-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>