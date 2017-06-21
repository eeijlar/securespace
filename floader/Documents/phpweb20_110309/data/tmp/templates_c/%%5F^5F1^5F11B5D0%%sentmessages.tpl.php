<?php /* Smarty version 2.6.18, created on 2008-10-21 18:34:25
         compiled from mail/lib/sentmessages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mail/lib/sentmessages.tpl', 12, false),array('modifier', 'escape', 'mail/lib/sentmessages.tpl', 14, false),array('function', 'geturl', 'mail/lib/sentmessages.tpl', 14, false),)), $this); ?>
<?php if ($this->_tpl_vars['totalMessages'] == 0): ?>
    <div id="outlineBorder">
	<div id="sessionSpacer"></div>
    <label id="margin">
         You have no sent messages.
    </label>
    </div>
<?php else: ?>		
		  <?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
		    <div style="border-left :solid 1px #AEC4DE; border-right :solid 1px #AEC4DE">
			<div class="inboxSpacer"></div>
			<label class="date_message"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']->ts_created)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d/%m/%Y %H:%M:%S') : smarty_modifier_date_format($_tmp, '%d/%m/%Y %H:%M:%S')); ?>
</label>	
			<img class="mail_icon" src="/images/mail.png" alt="mail" width="20" height="20"/>
			<label class="from_message"><a href="<?php echo smarty_function_geturl(array('action' => 'view'), $this);?>
?id=<?php echo $this->_tpl_vars['message']->getId(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']->profile->from)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></label>
			<label class="subject_message"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']->profile->subject)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label> 			
		    </div>
		  <?php endforeach; endif; unset($_from); ?>
		  <div id ="inboxSpacer" style="border-left :solid 1px #AEC4DE; border-right :solid 1px #AEC4DE"></div>	
		  <div style="border-bottom :solid 1px #AEC4DE"></div>		  	
<?php endif; ?>
