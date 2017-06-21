<?php /* Smarty version 2.6.18, created on 2009-09-14 22:26:22
         compiled from lib/error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_array', 'lib/error.tpl', 1, false),array('modifier', 'strlen', 'lib/error.tpl', 1, false),array('modifier', 'escape', 'lib/error.tpl', 10, false),)), $this); ?>
<?php if (is_array($this->_tpl_vars['error']) || ((is_array($_tmp=$this->_tpl_vars['error'])) ? $this->_run_mod_handler('strlen', true, $_tmp) : strlen($_tmp)) > 0): ?>
    <?php $this->assign('hasError', true); ?>
<?php else: ?>
    <?php $this->assign('hasError', false); ?>
<?php endif; ?>
<div class="error"<?php if (! $this->_tpl_vars['hasError']): ?> style="color:#FF0000" <?php else: ?> style="color:#FF0000" <?php endif; ?>>
    <?php if (is_array($this->_tpl_vars['error'])): ?>
        <ul>
            <?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str']):
?>
                <li><?php echo ((is_array($_tmp=$this->_tpl_vars['str'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    <?php else: ?>
        <?php echo ((is_array($_tmp=$this->_tpl_vars['error'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 
    <?php endif; ?>
</div>