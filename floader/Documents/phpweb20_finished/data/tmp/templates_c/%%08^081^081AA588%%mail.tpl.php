<?php /* Smarty version 2.6.18, created on 2009-05-26 11:28:04
         compiled from mail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mail.tpl', 2, false),)), $this); ?>
<div>
<label>Welcome, <?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->first_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 </label>
</div>
<div class = "mailSpacer"></div>
<?php if ($this->_tpl_vars['user_type'] == 'member'): ?>

<div>
	<label style="float:left;">Therapist: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->sme)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 </b></label>
	<label style="float:right;">Credits: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->credits)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</b></label>
</div>

<div class = "inboxSpacer"></div>
<div class = "inboxSpacer"></div>
<div class = "inboxSpacer"></div>
<div class = "inboxSpacer"></div>
<div class = "inboxSpacer"></div>

<?php endif; ?>
<div id="navigation">
<ul>
<?php if ($this->_tpl_vars['identity']->newMessages): ?>
<li id="inboxSelected"><a href="/mail/inbox">Inbox <b>(<?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->newMessages)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)</b></a></li>
<?php else: ?>
<li id="inboxSelected"><a href="/mail/inbox">Inbox</a></li>
<?php endif; ?>
<li><a href="/mail/sent">Sent Items</a></li>
<?php if ($this->_tpl_vars['user_type'] != 'member'): ?>
<li><a href="/sme/clients">Clients</a></li>
<li><a href="/mail/newmessage" class="sme_message">Write Message</a></li>
<?php else: ?>
<li><a href="/mail/newmessage" class="message">Write Message</a></li>
<?php endif; ?>
</ul>
</div>
<div id="inboxBorder">
</div>