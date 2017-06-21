<?php /* Smarty version 2.6.18, created on 2008-10-16 03:18:09
         compiled from account/fetchpassword.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'account/fetchpassword.tpl', 4, false),array('function', 'geturl', 'account/fetchpassword.tpl', 10, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'login_header.tpl', 'smarty_include_vars' => array('section' => 'login')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['action'] == 'confirm'): ?>
    <?php if (count($this->_tpl_vars['errors']) == 0): ?>
        <p>
            Your new password has now been activated.
        </p>

        <ul>
            <li><a href="<?php echo smarty_function_geturl(array('action' => 'login'), $this);?>
">Log in to your account</a></li>
        </ul>
    <?php else: ?>
        <p>
            Your new password was not confirmed. Please double-check the link
            sent to you by e-mail, or try using the
            <a href="<?php echo smarty_function_geturl(array('action' => 'fetchpassword'), $this);?>
">Fetch Password</a> tool again.
        </p>
    <?php endif; ?>
<?php elseif ($this->_tpl_vars['action'] == 'complete'): ?>
    <p>
        A password has been sent to your account e-mail address containing
        your new password. You must click the link in this e-mail to activate
        the new password.
    </p>
<?php else: ?>
    <form method="post" action="<?php echo smarty_function_geturl(array('action' => 'fetchpassword'), $this);?>
">
        <fieldset>
            <legend>Fetch Your Password</legend>

            <div class="row" id="form_username_container">
                <label for="form_username">Username:</label>
                <input type="text" id="form_username" name="username" />
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['errors']['username'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
            <div class="submit">
                <input type="submit" value="Fetch Password" />
            </div>
        </fieldset>
    </form>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>