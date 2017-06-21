<?php /* Smarty version 2.6.18, created on 2008-10-05 23:10:51
         compiled from header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'header.tpl', 7, false),array('modifier', 'strlen', 'header.tpl', 17, false),array('function', 'geturl', 'header.tpl', 45, false),array('function', 'breadcrumbs', 'header.tpl', 69, false),)), $this); ?>
<!DOCTYPE html
   PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title><?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="/css/styles.css" type="text/css" media="all" />

        <script type="text/javascript" src="/js/prototype.js"></script>
        <script type="text/javascript"
                src="/js/scriptaculous/scriptaculous.js"></script>
        <script type="text/javascript" src="/js/SearchSuggestor.class.js"></script>
        <script type="text/javascript" src="/js/scripts.js"></script>

        <?php if (((is_array($_tmp=$this->_tpl_vars['feedUrl'])) ? $this->_run_mod_handler('strlen', true, $_tmp) : strlen($_tmp)) > 0 && ((is_array($_tmp=$this->_tpl_vars['feedTitle'])) ? $this->_run_mod_handler('strlen', true, $_tmp) : strlen($_tmp)) > 0): ?>
            <link rel="alternate" type="application/atom+xml"
                  title="<?php echo ((is_array($_tmp=$this->_tpl_vars['feedTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['feedUrl'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
        <?php endif; ?>

        <?php if ($this->_tpl_vars['lightbox']): ?>
            <script type="text/javascript" src="/js/lightbox.js"></script>
            <link rel="stylesheet" href="/css/lightbox.css" type="text/css" />
        <?php endif; ?>

        <?php if ($this->_tpl_vars['maps']): ?>
            <script type="text/javascript"
                    src="http://www.google.com/jsapi?key=<?php echo ((is_array($_tmp=$this->_tpl_vars['config']->google->maps->key)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"></script>

            <?php if ($this->_tpl_vars['section'] == 'blogmanager'): ?>
                <script type="text/javascript"
                        src="/js/BlogLocationManager.class.js"></script>
            <?php endif; ?>
        <?php endif; ?>
    </head>
    <body>
        <div id="header">
            <img src="/images/logo-print.gif" alt="" />
        </div>

        <div id="nav">
            <ul>
                <li<?php if ($this->_tpl_vars['section'] == 'home'): ?> class="active"<?php endif; ?>>
                    <a href="<?php echo smarty_function_geturl(array('controller' => 'index'), $this);?>
">Home</a>
                </li>
                <?php if ($this->_tpl_vars['authenticated']): ?>
                    <li<?php if ($this->_tpl_vars['section'] == 'account'): ?> class="active"<?php endif; ?>>
                        <a href="<?php echo smarty_function_geturl(array('controller' => 'account'), $this);?>
">Your Account</a>
                    </li>
                    <li<?php if ($this->_tpl_vars['section'] == 'blogmanager'): ?> class="active"<?php endif; ?>>
                      <a href="<?php echo smarty_function_geturl(array('controller' => 'blogmanager'), $this);?>
">Your Blog</a>
                    </li>
                    <li><a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'logout'), $this);?>
">Logout</a></li>
                <?php else: ?>
                    <li<?php if ($this->_tpl_vars['section'] == 'register'): ?> class="active"<?php endif; ?>>
                        <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'register'), $this);?>
">Register</a>
                    </li>
                    <li<?php if ($this->_tpl_vars['section'] == 'login'): ?> class="active"<?php endif; ?>>
                        <a href="<?php echo smarty_function_geturl(array('controller' => 'account','action' => 'login'), $this);?>
">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <div id="content-container" class="column">
            <div id="content">
                <div id="breadcrumbs">
                    <?php echo smarty_function_breadcrumbs(array('trail' => $this->_tpl_vars['breadcrumbs']->getTrail(),'separator' => ' &raquo; '), $this);?>

                </div>

                <h1>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    <?php if (((is_array($_tmp=$this->_tpl_vars['feedUrl'])) ? $this->_run_mod_handler('strlen', true, $_tmp) : strlen($_tmp)) > 0 && ((is_array($_tmp=$this->_tpl_vars['feedTitle'])) ? $this->_run_mod_handler('strlen', true, $_tmp) : strlen($_tmp)) > 0): ?>
                        <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['feedUrl'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['feedTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
                            <img src="/images/feed-icon-14x14.png"
                                 alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['feedTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
                        </a>
                    <?php endif; ?>
                </h1>