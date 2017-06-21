<?php /* Smarty version 2.6.18, created on 2008-10-19 12:44:26
         compiled from account/registersme.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'account/registersme.tpl', 16, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sme_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class = "mailSpacer"></div>

<form  method="post" action="/account/registersme" id="registrationform" name="registration">
	<fieldset>
		<legend>Create SME Account</legend>
		<div class="error"<?php if (! $this->_tpl_vars['fp']->hasError()): ?> style="display: none"<?php endif; ?>>
			An error has occurred in the form below. Please check
			the highlighted fields and re-submit the form.
		</div>

		<div class="row" id="form_first_name_container">
			<label for="form_first_name">First Name</label>
			<input type="text" id="form_first_name"
				name="first_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->first_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="30"/>
			<span style="color:#FF0000;" id="firstNameError"></span>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('first_name'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		<div class="row" id="form_last_name_container">
			<label for="form_last_name">Last Name</label>
			<input type="text" id="form_last_name"
				name="last_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->last_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="30"
				onclick="isValidFirstName(this.form.first_name.value);"/>
			<span style="color:#FF0000;" id="lastNameError"></span>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('last_name'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		
		<div class="row" id="form_username_container">
			<label for="form_username">Username</label>
			<input type="text" id="form_username"
				name="username" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->username)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="15"
				onclick="isValidLastName(this.form.last_name.value);"/>
			<span style="color:#FF0000;" id="usernameerror"></span>	
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('username'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		<div class="row" id="form_email_container">
			<label for="form_email">E-mail Address</label>
			<input type="text" id="form_email"
				name="email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->email)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="30"
				onclick="isValidUserName(this.form.username.value);"/>		
			<span style="color:#FF0000;" id="emailerror"></span>	
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('email'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		<div class="row" id="form_verifyemail_container">
			<label for="form_email">Verify E-mail Address</label>
			<input type="text" id="form_email_verify"
				name="verify_email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->verify_email)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="30"
				onclick="isValidEmail(this.form.email.value);"/>
			<span style="color:#FF0000;" id="verifyemailerror"></span>	
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('verify_email'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>	
		
		<div class="row">
			<label>Mobile Number</label><br></br>
		</div>

        <div>
        	<ul>
	          	<li class="first">Country Code</li>
	            <li class="second_label">Area Code</li>
	            <li class="last">Local Number</li>        	           
        	</ul>       
       </div>
       
        <div class="mobile">
        	<ul>
	           	<li class="inline"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'account/lib/countries.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	           			<input type="hidden" name="countryCode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->countryCode)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/></li>	           				
	            <li class="inline"><input type="text" id="area_code_container"
	        	           name="area_code" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->area_code)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="7" size="12"
	        	           onclick="checkAddressMatch(this.form.email.value,this.form.verify_email.value)"/>
	        	 </li>
	            <li class="inline"><input type="text" id="local_number_container"
	        	           name="local_number" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fp']->local_number)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="9" size="13"
	        	           onselect="this.form.area_code.value=stripZero(this.form.area_code.value)"/>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('local_number'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></li>        	           
	        </ul>      
		</div>
		
		<div>
			<span style="float:left; padding-top:3px; color:#FF0000;" id="displayMobile"></span>
			<span style="float:left; padding-top:3px; font-weight:bold;" id="displayMobileOK"></span>
		</div>
		</fieldset>
		<fieldset>
			<legend>Profile</legend>	
			<div>
			<label><b>Please enter some profile information for the SME. This will be used by clients to aid selection.</b></label>
			<div>&nbsp;</div>
			<textarea onclick="this.form.mobile.value=updateMobileNumber(this.form.countryCode.value,this.form.areacode.value,this.form.localnumber.value);" class="textarea" name="smeprofile" cols="65"
			rows="10"></textarea>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'lib/error.tpl', 'smarty_include_vars' => array('error' => $this->_tpl_vars['fp']->getError('smeprofile'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>	
			<div>&nbsp;</div>		
			<div class="submit" align="center">
				<input type="submit" value="Register" />
			</div>			
		</fieldset>
</form>		
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>