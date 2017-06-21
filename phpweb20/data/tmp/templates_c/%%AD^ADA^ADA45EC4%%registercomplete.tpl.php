<?php /* Smarty version 2.6.18, created on 2009-10-06 12:14:01
         compiled from account/registercomplete.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'account/registercomplete.tpl', 4, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'login_header.tpl', 'smarty_include_vars' => array('active' => 'register')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<p>
    Thank you <?php echo ((is_array($_tmp=$this->_tpl_vars['user']->profile->first_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
,
    your registration is now complete.
</p>

<p>
    Your login information has been e-mailed to you at <?php echo ((is_array($_tmp=$this->_tpl_vars['user']->profile->email)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
. 
</p>
<br />
<p>
    <a href="http://www.securecounselling.ie">Return to Secure Counselling</a>
</p>

<div class="bigSpacer"></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>