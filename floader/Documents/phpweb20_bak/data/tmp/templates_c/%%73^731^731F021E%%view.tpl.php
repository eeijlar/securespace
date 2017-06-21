<?php /* Smarty version 2.6.18, created on 2008-10-19 12:41:51
         compiled from profile/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'imagefilename', 'profile/view.tpl', 8, false),)), $this); ?>
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
<?php if ($this->_tpl_vars['user_type'] != 'member'): ?>
		<div class="margin">
			<label><b>Your current profile picture</b></label>
			<div class="mailSpacer"></div>
			<p>
		      <img src="<?php echo smarty_function_imagefilename(array('id' => $this->_tpl_vars['user_id'],'w' => 400,'h' => 100), $this);?>
" alt="<?php echo $this->_tpl_vars['alt']; ?>
"/>
		   	</p>
		   	<div class="mailSpacer"></div>
		   	<form method="post"
		          action="/profile/upload"
		          enctype="multipart/form-data">
		
		        <div>
		            <input type="submit" value="Upload" name="upload"/>
		            <input type="file" name="image"/> 
		        </div>
		    </form>
	  </div>
 </div> 
<?php else: ?>
<div id="inboxBorder">
</div>
</div>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>