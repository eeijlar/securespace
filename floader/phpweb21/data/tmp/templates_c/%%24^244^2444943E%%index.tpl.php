<?php /* Smarty version 2.6.18, created on 2008-10-05 23:11:05
         compiled from blogmanager/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'blogmanager/index.tpl', 18, false),)), $this); ?>
<?php if ($this->_tpl_vars['isXmlHttpRequest']): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'blogmanager/lib/month-preview.tpl', 'smarty_include_vars' => array('month' => $this->_tpl_vars['month'],'posts' => $this->_tpl_vars['recentPosts'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array('section' => 'blogmanager')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <?php if ($this->_tpl_vars['totalPosts'] == 1): ?>
        <p>
            There is currently 1 post in your blog.
        </p>
    <?php else: ?>
        <p>
            There are currently <?php echo $this->_tpl_vars['totalPosts']; ?>
 posts in your blog.
        </p>
    <?php endif; ?>

    <form method="get" action="<?php echo smarty_function_geturl(array('action' => 'edit'), $this);?>
">
        <div class="submit">
            <input type="submit" value="Create new blog post" />
        </div>
    </form>

    <div id="month-preview">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'blogmanager/lib/month-preview.tpl', 'smarty_include_vars' => array('month' => $this->_tpl_vars['month'],'posts' => $this->_tpl_vars['recentPosts'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array('leftcolumn' => 'blogmanager/lib/left-column.tpl')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>