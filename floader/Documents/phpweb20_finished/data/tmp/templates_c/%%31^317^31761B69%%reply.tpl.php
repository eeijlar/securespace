<?php /* Smarty version 2.6.18, created on 2008-10-20 17:56:54
         compiled from mail/reply.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mail/reply.tpl', 13, false),array('function', 'wysiwyg', 'mail/reply.tpl', 22, false),)), $this); ?>
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

    <?php if (( $this->_tpl_vars['credits'] == 0 && $this->_tpl_vars['user_type'] == 'member' )): ?>
    <div id = "outlineBorder">
   	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'paypal.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   	</div>	
    <?php else: ?>
    	<div id="inboxHeader"></div>
    	<form  action="/mail/reply" method="post">
    	<div>
        	<b><label for="form_subject">To</label></b>
         	<label for="form_subject"><?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label>
    	</div>
    	<div id = "inboxHeader"></div>
    	 <div>
        	<b><label for="form_subject">Subject</label></b>
        	<label>Re: <?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->subject)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label>
    	</div>
    	<div id = "inboxHeader"></div>
		<div>
   		<?php echo smarty_function_wysiwyg(array('name' => 'body'), $this);?>

   		</div>
   		<div id = "inboxHeader"></div>
   		<div class="submit" align="left">
			<input type="submit" value="Send" />
		</div>
		</form>
    <?php endif; ?>
  
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>