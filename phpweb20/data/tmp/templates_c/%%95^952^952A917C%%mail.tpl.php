<?php /* Smarty version 2.6.18, created on 2009-05-26 11:29:00
         compiled from profile/lib/mail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'profile/lib/mail.tpl', 2, false),)), $this); ?>
<div>
<label>Welcome, <?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->first_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 </label>
</div>
<div class = "mailSpacer"></div>

<?php if ($this->_tpl_vars['user_type'] != 'member'): ?>
<?php else: ?>
<div>
        <label style="float:left">Therapist: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->sme)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 </b></label>
        <label style="float:right">Credits: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->credits)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</b></label>
</div>

<div id = "inboxHeader"></div>
<div id = "inboxHeader"></div>
<div id = "inboxHeader"></div>
<div id = "inboxHeader"></div>

<?php endif; ?>
<div id="navigation">
<ul>
<?php if ($this->_tpl_vars['user_type'] != 'member'): ?>
        <li id="inboxSelected"><a href="/profile/view">Profile Picture</a></li>
        <li><a href="/profile/update">Change Information</a></li>
        <li><a href="/account/details">Change Password</a></li>
<?php else: ?>
        <li><a href="/account/details">Change Password</a></li>
<?php endif; ?>
</ul>
</div>

<div id="inboxBorder">
</div>
<div id = "outlineBorder">
        <div class="mailSpacer"></div>
