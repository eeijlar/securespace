<?php /* Smarty version 2.6.18, created on 2008-10-19 13:05:29
         compiled from profile/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'profile/update.tpl', 8, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'login_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'profile/lib/mail.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="margin"><br/>
	<form method="post" action="/profile/update">
		<label><b>Your current profile</b></label>
		<div class="mailSpacer"></div>
		<?php if ($this->_tpl_vars['smeprofile']): ?>
		<textarea class="textarea" name="smeprofile" cols="65" rows="10"><?php echo ((is_array($_tmp=$this->_tpl_vars['smeprofile'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

		</textarea>
		<?php else: ?>
		<textarea class="textarea" name="smeprofile" cols="65" rows="10"></textarea>		
		<?php endif; ?>
		<div class="mailSpacer"></div>
		<div class="submit">
			<input type="submit" value="Update" />
		</div>
	</form>
	</div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>