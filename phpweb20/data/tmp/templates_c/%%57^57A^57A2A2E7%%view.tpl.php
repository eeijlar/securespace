<?php /* Smarty version 2.6.18, created on 2009-10-06 08:05:53
         compiled from mail/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mail/view.tpl', 10, false),)), $this); ?>
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
<div id="content">
	<div id="mainContentWide">

<div id="spacer"></div>
	<form action="/mail/reply" method="post">
<div id="outlineBorder">
    <div id="padding">
    <div><label><b>From:</b> <?php echo ((is_array($_tmp=$this->_tpl_vars['profile']->from)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label></div>	
    <div id = "inboxHeader"></div>
    <div><label><b>To:</b> <?php echo ((is_array($_tmp=$this->_tpl_vars['profile']->to)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</label></div>
    <div id = "inboxHeader"></div>	
    <div><p><?php echo $this->_tpl_vars['body']; ?>
<p></div>	
    </div>
    <div id = "inboxHeader"></div>
    <div id = "inboxHeader"></div>
    <div id = "inboxHeader"></div>
    <div id = "inboxHeader"></div>
    <div id = "inboxHeader"></div>
    <div id = "inboxHeader"></div>
    
</div>
	<div class="submit" align="left">
         <?php if ($this->_tpl_vars['name'] != 'Secure Counselling'): ?>
	     <input type="submit" value="Reply" />
        <?php endif; ?>
	</div>
	</form>
</div><!--maincontentwide-->
</div><!--content-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>