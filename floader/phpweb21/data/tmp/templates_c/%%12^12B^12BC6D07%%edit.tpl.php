<?php /* Smarty version 2.6.18, created on 2008-10-13 23:19:04
         compiled from blogmanager/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'blogmanager/edit.tpl', 3, false),array('function', 'html_select_date', 'blogmanager/edit.tpl', 26, false),array('function', 'html_select_time', 'blogmanager/edit.tpl', 31, false),array('function', 'wysiwyg', 'blogmanager/edit.tpl', 41, false),array('modifier', 'escape', 'blogmanager/edit.tpl', 19, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array('section' => 'blogmanager')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post" action="<?php echo smarty_function_geturl(array('action' => 'edit'), $this);?>
?id=<?php echo $this->_tpl_vars['fp']->post->getId(); ?>
">

<?php if ($this->_tpl_vars['fp']->hasError()): ?>
    <div class="error">
        An error has occurred in the form below. Please check
        the highlighted fields and resubmit the form.
    </div>
<?php endif; ?>


<fieldset>
    <legend>Blog Post Details</legend>

    <div class="row" id="form_title_container">
        <label for="form_title">Title:</label>
        <input type="text" id="form_title"
               name="username" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->title)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('title'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

    <div class="row" id="form_date_container">
        <label for="form_date">Date of Entry:</label>

        <?php echo smarty_function_html_select_date(array('prefix' => 'ts_created','time' => $this->_tpl_vars['fp']->ts_created,'start_year' => -5,'end_year' => "+5"), $this);?>


        <?php echo smarty_function_html_select_time(array('prefix' => 'ts_created','time' => $this->_tpl_vars['fp']->ts_created,'display_seconds' => false,'use_24_hours' => false), $this);?>


        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('date'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
</fieldset>

<div class="wysiwyg">
    <?php echo smarty_function_wysiwyg(array('name' => 'content','value' => $this->_tpl_vars['fp']->content), $this);?>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('content'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<div class="submit">
    <?php if ($this->_tpl_vars['fp']->post->isLive()): ?>
        <?php $this->assign('label', 'Save Changes'); ?>
    <?php elseif ($this->_tpl_vars['fp']->post->isSaved()): ?>
        <?php $this->assign('label', 'Save Changes and Send Live'); ?>
    <?php else: ?>
        <?php $this->assign('label', 'Create and Send Live'); ?>
    <?php endif; ?>

    <input type="submit" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <?php if (! $this->_tpl_vars['fp']->post->isLive()): ?>
        <input type="submit" name="preview" value="Preview This Post" />
    <?php endif; ?>
</div>

</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array('leftcolumn' => 'blogmanager/lib/left-column.tpl')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>