<?php /* Smarty version 2.6.18, created on 2008-10-05 23:10:51
         compiled from index/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'index/index.tpl', 3, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array('section' => 'home')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (count($this->_tpl_vars['posts']) == 0): ?>
    <p>
        No blog posts were found!
    </p>
<?php else: ?>
    <?php $_from = $this->_tpl_vars['posts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['posts'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['posts']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['post']):
        $this->_foreach['posts']['iteration']++;
?>
        <?php $this->assign('user_id', $this->_tpl_vars['post']->user_id); ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'user/lib/blog-post-summary.tpl', 'smarty_include_vars' => array('post' => $this->_tpl_vars['post'],'user' => $this->_tpl_vars['users'][$this->_tpl_vars['user_id']],'linkToBlog' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>