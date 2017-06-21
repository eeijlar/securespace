<?php /* Smarty version 2.6.18, created on 2008-10-18 16:36:46
         compiled from mail/newmessage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'mail/newmessage.tpl', 26, false),array('modifier', 'escape', 'mail/newmessage.tpl', 26, false),array('function', 'wysiwyg', 'mail/newmessage.tpl', 39, false),)), $this); ?>
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
    <div id="outlineBorder">
    <div id="inboxHeader"></div>
   	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'paypal.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
    </div>
    <?php else: ?>
    	<?php if ($this->_tpl_vars['noclients']): ?>
    	    <div id="outlineBorder">
			    <div id="inboxHeader"></div>
	    		<div class="margin">
	    			<p>You currently have no active clients. Check the 'Clients' tab and accept a client.</p>
	    		</div>
    		</div>
    	<?php else: ?>
	    	<form  action="/mail/newmessage" method="post">
	    	<?php if ($this->_tpl_vars['user_type'] == 'sme' || $this->_tpl_vars['user_type'] == 'administrator'): ?>
	    	    <div class="row" id="form_subject_container">
	        	<label for="form_subject">To</label>
	         	<dd>
	            	<select name="client">
	               	  <?php $_from = $this->_tpl_vars['clients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['client']):
?>
			 			 <option value="<?php echo $this->_tpl_vars['client']['name']; ?>
"
	                  	<?php if (! $this->_tpl_vars['fp']->client): ?> selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['client']['name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</option>
					  <?php endforeach; endif; unset($_from); ?>
	            	</select>
	        	</dd>
	    	</div>
	    	<?php endif; ?>
	    	 <div class="row" id="form_subject_container">
	        	<label for="form_subject">Subject</label>
	        	<input type="text" id="form_subject"
	               name="subject" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->subject)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('subject'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	    	</div>
			<div>
	   		<?php echo smarty_function_wysiwyg(array('name' => 'body','value' => $this->_tpl_vars['fp']->body), $this);?>

	   		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('body'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	   		</div>
	   		<div class="submit" align="left">
				<input type="submit" value="Send" />
			</div>
			</form>
		<?php endif; ?>	
    <?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>