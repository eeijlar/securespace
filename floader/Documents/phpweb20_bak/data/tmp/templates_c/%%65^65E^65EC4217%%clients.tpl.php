<?php /* Smarty version 2.6.18, created on 2008-10-18 16:36:06
         compiled from sme/clients.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'sme/clients.tpl', 9, false),array('modifier', 'escape', 'sme/clients.tpl', 9, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'login_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'mail.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id = "spacer"></div>
<form  action="/sme/process" method="post">
		<?php $_from = $this->_tpl_vars['clients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['client']):
?>
			<div class="clientsHeader">
			<div class= "margin">		
				<label><b>Name</b></label>
			 	<label><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['client']['name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label>
				<div class = "mailSpacer"></div>
			 	<label><b>Story</b></label>
			 	<label><?php echo ((is_array($_tmp=$this->_tpl_vars['client']['story'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label>
				<div class = "mailSpacer"></div>
			 	<label><b>Status</b></label>
			 	<label><?php echo ((is_array($_tmp=$this->_tpl_vars['client']['status'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label>
				<div class = "mailSpacer"></div>
			 	<?php if ($this->_tpl_vars['client']['status'] == 'Processed'): ?>

			 	<div id="navigation">
			 		<ul>
					<li><a href="/sme/process?id=<?php echo ((is_array($_tmp=$this->_tpl_vars['client']['user_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&action=accept">Accept</a></li>
					<li><a href="/sme/process?id=<?php echo ((is_array($_tmp=$this->_tpl_vars['client']['user_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&action=reject">Reject</a></li>
					</ul>
				</div>
		 		<?php endif; ?>
			</div>
		 	</div>
		<?php endforeach; endif; unset($_from); ?>	
		<div id="mailFooter"></div>	
</form>		  	  

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>