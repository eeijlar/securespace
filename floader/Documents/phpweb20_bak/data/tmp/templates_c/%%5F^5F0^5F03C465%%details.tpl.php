<?php /* Smarty version 2.6.18, created on 2008-10-19 13:05:50
         compiled from account/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'account/details.tpl', 5, false),array('modifier', 'escape', 'account/details.tpl', 25, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'login_header.tpl', 'smarty_include_vars' => array('section' => 'account')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'profile/lib/mail.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="margin">
<form method="post" action="<?php echo smarty_function_geturl(array('action' => 'details'), $this);?>
">
	<div id = "inboxHeader"></div>
    <legend><b>Update Your Details</b></legend>

    <?php if ($this->_tpl_vars['fp']->hasError()): ?>
        <div class="error">
            An error has occurred in the form below. Please check
            the highlighted fields and re-submit the form.
        </div>
    <?php endif; ?>

    <p>
        To change your account password, enter a new password below.
        If you leave this field blank your password will remain
        unchanged.
    </p>

    <div class="row" id="form_email_container">
        <label for="form_email">E-mail Address:</label>
        <input type="text" id="form_email"
               name="email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->email)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('email'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

    <div class="row" id="form_first_name_container">
        <label for="form_first_name">First Name:</label>
        <input type="text" id="form_first_name"
               name="first_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->first_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('first_name'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

    <div class="row" id="form_last_name_container">
        <label for="form_last_name">Last Name:</label>
        <input type="text" id="form_last_name"
               name="last_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->last_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('last_name'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

    <div class="row" id="form_password_container">
        <label for="form_password">Password:</label>
        <input type="password" id="form_password"
               name="password" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->password)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('password'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

    <div class="row" id="form_password_confirm_container">
        <label for="form_password_confirm">Retype Password:</label>
        <input type="password" id="form_password_confirm"
               name="password_confirm" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->password_confirm)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('password_confirm'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>   
    
    <div class="submit">
    	<input class="customLogin" type="submit" value="Save" />
	</div>
</form>
</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>