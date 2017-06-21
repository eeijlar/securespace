<?php /* Smarty version 2.6.18, created on 2008-10-05 23:11:05
         compiled from blogmanager/lib/month-preview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'blogmanager/lib/month-preview.tpl', 1, false),array('modifier', 'count', 'blogmanager/lib/month-preview.tpl', 3, false),array('modifier', 'escape', 'blogmanager/lib/month-preview.tpl', 13, false),array('function', 'geturl', 'blogmanager/lib/month-preview.tpl', 12, false),)), $this); ?>
<h2><?php echo ((is_array($_tmp=$this->_tpl_vars['month'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%B %Y') : smarty_modifier_date_format($_tmp, '%B %Y')); ?>
</h2>

<?php if (count($this->_tpl_vars['posts']) == 0): ?>
    <p>
        No posts found for this month.
    </p>
<?php else: ?>
    <dl>
        <?php $_from = $this->_tpl_vars['posts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['post']):
?>
            <dt>
                <?php echo ((is_array($_tmp=$this->_tpl_vars['post']->ts_created)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%a, %e %b') : smarty_modifier_date_format($_tmp, '%a, %e %b')); ?>
:
                <a href="<?php echo smarty_function_geturl(array('action' => 'preview'), $this);?>
?id=<?php echo $this->_tpl_vars['post']->getId(); ?>
">
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['post']->profile->title)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                </a>
                <?php if (! $this->_tpl_vars['post']->isLive()): ?>
                    <span class="status draft">not published</span>
                <?php endif; ?>
            </dt>
            <dd>
                <?php echo ((is_array($_tmp=$this->_tpl_vars['post']->getTeaser(100))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

            </dd>
        <?php endforeach; endif; unset($_from); ?>
    </dl>
<?php endif; ?>