<?php /* Smarty version 2.6.18, created on 2008-10-21 18:32:05
         compiled from mail/lib/messages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mail/lib/messages.tpl', 7, false),array('modifier', 'date_format', 'mail/lib/messages.tpl', 17, false),array('function', 'geturl', 'mail/lib/messages.tpl', 19, false),)), $this); ?>
		  <div id="outlineBorder">
		  <div id="sessionSpacer"></div>		  
			  <label id="margin">
			  <?php if ($this->_tpl_vars['totalMessages'] == 0): ?>
			  	There are no new messages in your inbox.		
			  <?php elseif ($this->_tpl_vars['totalMessages'] > 1): ?>
			  	You have <b><?php echo ((is_array($_tmp=$this->_tpl_vars['totalMessages'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</b> new messages
			  <?php else: ?>	
			    You have <b><?php echo ((is_array($_tmp=$this->_tpl_vars['totalMessages'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</b> new message
			  <?php endif; ?>	
			  </label>
			  <div id="inboxHeader"></div>
		
		  <?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
			<div class="inboxSpacer"></div>
			<?php if ($this->_tpl_vars['message']->message_status == 'New'): ?>
			<b><label class="date_message"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']->ts_created)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d/%m/%Y %H:%M:%S') : smarty_modifier_date_format($_tmp, '%d/%m/%Y %H:%M:%S')); ?>
</label>	
			<img class="mail_icon" src="/images/mail_receive.png" alt="mail" width="20" height="20"/>
			<label class="from_message"><a href="<?php echo smarty_function_geturl(array('action' => 'view'), $this);?>
?id=<?php echo $this->_tpl_vars['message']->getId(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']->profile->from)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></label>
			<label class="subject_message"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']->profile->subject)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label>  
			</b>
			<?php else: ?>
			<label class="date_message"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']->ts_created)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d/%m/%Y %H:%M:%S') : smarty_modifier_date_format($_tmp, '%d/%m/%Y %H:%M:%S')); ?>
</label>	
			<img class="mail_icon" src="/images/mail.png" alt="mail" width="20" height="20"/>
			<label class="from_message"><a href="<?php echo smarty_function_geturl(array('action' => 'view'), $this);?>
?id=<?php echo $this->_tpl_vars['message']->getId(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']->profile->from)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></label>
			<label class="subject_message"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']->profile->subject)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label> 
			<?php endif; ?>		
		  <?php endforeach; endif; unset($_from); ?>
		   </div>