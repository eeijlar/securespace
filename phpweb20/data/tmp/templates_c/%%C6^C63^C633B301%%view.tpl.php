<?php /* Smarty version 2.6.18, created on 2010-08-19 22:23:07
         compiled from sme/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'imagefilename', 'sme/view.tpl', 12, false),array('modifier', 'capitalize', 'sme/view.tpl', 14, false),array('modifier', 'escape', 'sme/view.tpl', 14, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content">
	<div id="mainContent">
<form method="post" action="/account/register">
		<h3>Meet Our Therapists</h3>
		<div class = "mailSpacer"></div>	
	
		<?php $_from = $this->_tpl_vars['smes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sme']):
?>
			<fieldset>
				<div class = "margin">
					<div>
				 		<img src="<?php echo smarty_function_imagefilename(array('id' => $this->_tpl_vars['sme']['user_id'],'w' => 200,'h' => 65), $this);?>
" alt="Profile Picture" class="imageRight" />
				 	</div>
					 	<p><b><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['sme']['name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</b></p>
					 	<p><?php echo ((is_array($_tmp=$this->_tpl_vars['sme']['smeprofile'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</p>
					 			 	
				</div>
			</fieldset>		
					<div id="navigation">
                                            <li>
                                               <a href="/account/register?sme=<?php echo ((is_array($_tmp=$this->_tpl_vars['sme']['user_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">Select</a>
                                            </li>
                                            <br></br>
                                        </div>
					
			<br></br>
		<?php endforeach; endif; unset($_from); ?>

</form>
</div><!--maincontent-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sidebar.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>