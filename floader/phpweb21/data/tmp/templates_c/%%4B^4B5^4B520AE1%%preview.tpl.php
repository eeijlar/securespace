<?php /* Smarty version 2.6.18, created on 2008-10-05 23:11:07
         compiled from blogmanager/preview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'blogmanager/preview.tpl', 7, false),array('function', 'imagefilename', 'blogmanager/preview.tpl', 78, false),array('modifier', 'escape', 'blogmanager/preview.tpl', 50, false),array('modifier', 'count', 'blogmanager/preview.tpl', 74, false),array('modifier', 'date_format', 'blogmanager/preview.tpl', 127, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array('section' => 'blogmanager')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript" src="/js/blogPreview.js"></script>
<script type="text/javascript" src="/js/BlogImageManager.class.js"></script>

<form method="post"
      action="<?php echo smarty_function_geturl(array('controller' => 'blogmanager','action' => 'setstatus'), $this);?>
"
      id="status-form">

<div class="preview-status">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['post']->getId(); ?>
" />
    <?php if ($this->_tpl_vars['post']->isLive()): ?>
        <div class="status live">
            This post is live on your blog. To unpublish
            it click the <strong>Unpublish post</strong> button below.
            <div>
                <input type="submit" value="Unpublish post"
                       name="unpublish" id="status-unpublish" />
                <input type="submit" value="Edit post"
                       name="edit" id="status-edit" />
                <input type="submit" value="Delete post"
                       name="delete" id="status-delete" />
            </div>
        </div>
    <?php else: ?>
        <div class="status draft">
            This post is not yet live on your blog. To publish
            it on your blog, click the button below.
            <div>
                <input type="submit" value="Publish post"
                       name="publish" id="status-publish" />
                <input type="submit" value="Edit post"
                       name="edit" id="status-edit" />
                <input type="submit" value="Delete post"
                       name="delete" id="status-delete" />
            </div>
        </div>
    <?php endif; ?>
</div>

</form>

<fieldset id="preview-tags">
    <legend>Tags</legend>
    <ul>
        <?php $_from = $this->_tpl_vars['post']->getTags(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tag']):
?>
            <li>
                <form method="post" action="<?php echo smarty_function_geturl(array('action' => 'tags'), $this);?>
">
                    <div>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['tag'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['post']->getId(); ?>
" />
                        <input type="hidden" name="tag" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['tag'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
                        <input type="submit" value="Delete" name="delete" />
                    </div>
                </form>
            </li>
        <?php endforeach; else: ?>
            <li>No tags found</li>
        <?php endif; unset($_from); ?>
    </ul>

    <form method="post" action="<?php echo smarty_function_geturl(array('action' => 'tags'), $this);?>
">
        <div>
            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['post']->getId(); ?>
" />
            <input type="text" name="tag" />
            <input type="submit" value="Add Tag" name="add" />
        </div>
    </form>
</fieldset>

<fieldset id="preview-images">
    <legend>Images</legend>

    <?php if (count($this->_tpl_vars['post']->images) > 0): ?>
        <ul id="post_images">
            <?php $_from = $this->_tpl_vars['post']->images; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
                <li id="image_<?php echo $this->_tpl_vars['image']->getId(); ?>
">
                    <img src="<?php echo smarty_function_imagefilename(array('id' => $this->_tpl_vars['image']->getId(),'w' => 200,'h' => 65), $this);?>
"
                         alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['image']->filename)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />

                    <form method="post" action="<?php echo smarty_function_geturl(array('action' => 'images'), $this);?>
">
                        <div>
                            <input type="hidden"
                                   name="id" value="<?php echo $this->_tpl_vars['post']->getId(); ?>
" />
                            <input type="hidden"
                                   name="image" value="<?php echo $this->_tpl_vars['image']->getId(); ?>
" />
                            <input type="submit" value="Delete" name="delete" />
                        </div>
                    </form>
                </li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    <?php endif; ?>

    <form method="post"
          action="<?php echo smarty_function_geturl(array('action' => 'images'), $this);?>
"
          enctype="multipart/form-data">

        <div>
            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['post']->getId(); ?>
" />
            <input type="file" name="image" />
            <input type="submit" value="Upload Image" name="upload" />
        </div>
    </form>
</fieldset>

<fieldset id="preview-locations">
    <legend>Locations</legend>

    <ul>
        <?php $_from = $this->_tpl_vars['post']->locations; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['location']):
?>
            <li><?php echo ((is_array($_tmp=$this->_tpl_vars['location']->description)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</li>
        <?php endforeach; else: ?>
            <li>No locations have been assigned to this post.</li>
        <?php endif; unset($_from); ?>
    </ul>

    <form method="get" action="<?php echo smarty_function_geturl(array('action' => 'locations'), $this);?>
">
        <div>
            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['post']->getId(); ?>
" />
            <input type="submit" value="Manage Locations" />
        </div>
    </form>
</fieldset>

<div class="preview-date">
    <?php echo ((is_array($_tmp=$this->_tpl_vars['post']->ts_created)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%x %X') : smarty_modifier_date_format($_tmp, '%x %X')); ?>

</div>

<div class="preview-content">
    <?php echo $this->_tpl_vars['post']->profile->content; ?>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array('leftcolumn' => 'blogmanager/lib/left-column.tpl')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>