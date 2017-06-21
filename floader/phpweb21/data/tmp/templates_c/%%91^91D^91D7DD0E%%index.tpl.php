<?php /* Smarty version 2.6.18, created on 2008-10-05 23:11:02
         compiled from account/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'account/index.tpl', 6, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array('section' => 'account')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

Welcome <?php echo $this->_tpl_vars['identity']->first_name; ?>
.

<ul>
    <li><a href="<?php echo smarty_function_geturl(array('controller' => 'blogmanager'), $this);?>
">View all blog posts</a></li>
    <li><a href="<?php echo smarty_function_geturl(array('controller' => 'blogmanager','action' => 'edit'), $this);?>
">Post new blog entry</a></li>
</ul>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>