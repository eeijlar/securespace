<?php /* Smarty version 2.6.18, created on 2008-10-05 23:10:51
         compiled from footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'footer.tpl', 6, false),array('modifier', 'escape', 'footer.tpl', 8, false),array('modifier', 'strlen', 'footer.tpl', 15, false),array('modifier', 'count', 'footer.tpl', 21, false),)), $this); ?>
            </div>
        </div>

        <div id="left-container" class="column">
            <div class="box" id="search">
                <form method="get" action="<?php echo smarty_function_geturl(array('controller' => 'search'), $this);?>
">
                    <div>
                        <input type="text" name="q" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['q'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"
                               id="search-query" />
                        <input type="submit" value="Search" />
                    </div>
                </form>
            </div>

            <?php if (isset ( $this->_tpl_vars['leftcolumn'] ) && ((is_array($_tmp=$this->_tpl_vars['leftcolumn'])) ? $this->_run_mod_handler('strlen', true, $_tmp) : strlen($_tmp)) > 0): ?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['leftcolumn'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php endif; ?>
        </div>

        <div id="right-container" class="column">
            <?php if (count($this->_tpl_vars['messages']) > 0): ?>
                <div id="messages" class="box">
                    <?php if (count($this->_tpl_vars['messages']) == 1): ?>
                        <strong>Status Message:</strong>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['messages']['0'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    <?php else: ?>
                        <strong>Status Messages:</strong>
                        <ul>
                            <?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
                                <li><?php echo ((is_array($_tmp=$this->_tpl_vars['row'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</li>
                            <?php endforeach; endif; unset($_from); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div id="messages" class="box" style="display:none"></div>
            <?php endif; ?>

            <div class="box">
                <?php if ($this->_tpl_vars['authenticated']): ?>
                    Logged in as
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->first_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['identity']->last_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    (<a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'logout'), $this);?>
">logout</a>).
                    <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'details'), $this);?>
">Update details</a>.
                <?php else: ?>
                    You are not logged in.
                    <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'login'), $this);?>
">Log in</a> or
                    <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'register'), $this);?>
">register</a> now.
                <?php endif; ?>
            </div>

            <?php if (isset ( $this->_tpl_vars['rightcolumn'] ) && ((is_array($_tmp=$this->_tpl_vars['rightcolumn'])) ? $this->_run_mod_handler('strlen', true, $_tmp) : strlen($_tmp)) > 0): ?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['rightcolumn'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php endif; ?>
        </div>

        <div id="footer">
            Practical PHP Web 2.0 Applications, by Quentin Zervaas.
        </div>
    </body>
</html>