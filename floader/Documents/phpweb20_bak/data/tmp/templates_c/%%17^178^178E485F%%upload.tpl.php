<?php /* Smarty version 2.6.18, created on 2008-10-19 12:43:22
         compiled from profile/upload.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'profile/upload.tpl', 4, false),array('function', 'imagefilename', 'profile/upload.tpl', 9, false),)), $this); ?>
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
<div class="margin">
	<p><?php echo ((is_array($_tmp=$this->_tpl_vars['message'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</b>
		<div id="inboxHeader"></div>
		<label><b>Your profile picture</b></label>
		<div id="inboxHeader"></div>
		<p>
	    	<img src="<?php echo smarty_function_imagefilename(array('id' => $this->_tpl_vars['user_id'],'w' => 200,'h' => 65), $this);?>
" alt="<?php echo $this->_tpl_vars['alt']; ?>
"/>
	    </p>
	 </div> 
 </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>