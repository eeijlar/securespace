{include file='client_header.tpl'}
<div id="content">
<div id="mainContent">
<form  method="post" action="/account/register" id="registrationform" name="registration">
	<fieldset>
		<legend><b>Create Your {$website|escape} Account</b></legend>
        <div class="error"{if !$fp->hasError()} style="display: none"{/if}>
            An error has occurred in the form below. Please check
            the highlighted fields and re-submit the form.
        </div>

		<div class="row" id="form_first_name_container">
			<label for="form_first_name">First Name</label>
			<input type="text" id="form_first_name"
				name="first_name" value="{$fp->first_name|escape}" maxlength="30"/>
			<span style="color:#FF0000;" id="firstNameError"></span>
			{include file='lib/error.tpl' error=$fp->getError('first_name')}
		</div>

		<div class="row" id="form_last_name_container">
			<label for="form_last_name">Last Name</label>
			<input type="text" id="form_last_name"
				name="last_name" value="{$fp->last_name|escape}" maxlength="30"
				onclick="isValidFirstName(this.form.first_name.value);"/>
			<span style="color:#FF0000;" id="lastNameError"></span>
			{include file='lib/error.tpl' error=$fp->getError('last_name')}
		</div>	

		<div class="row" id="form_username_container">
			<label for="form_username">Username</label>
			<input type="text" id="form_username"
				name="username" value="{$fp->username|escape}" maxlength="15"
				onclick="isValidLastName(this.form.last_name.value)"/>
			<span style="color:#FF0000;" id="usernameerror"></span>	
			{include file='lib/error.tpl' error=$fp->getError('username')}
		</div>

		<div class="row" id="form_email_container">
			<label for="form_email">E-mail Address</label>
			<input type="text" id="form_email"
				name="email" value="{$fp->email|escape}" maxlength="30"
				onclick="isValidUserName(this.form.username.value)"/>		
			<span style="color:#FF0000;" id="emailerror"></span>	
			{include file='lib/error.tpl' error=$fp->getError('email')}
		</div>

		<div class="row" id="form_verifyemail_container">
			<label for="form_email">Verify E-mail Address</label>
			<input type="text" id="form_email_verify"
				name="verify_email" value="{$fp->verify_email|escape}" maxlength="30"
				onclick="isValidEmail(this.form.email.value)"/>
			<span style="color:#FF0000;" id="verifyemailerror"></span>	
			{include file='lib/error.tpl' error=$fp->getError('verify_email')}
		</div>	
		
             </fieldset>
             <fieldset>

             <legend><b>Mobile Number</b></legend>
                     <div class="row" id="mobileTable">
                        <div style="float: left;"><label>Country Code</label></div>
                        <div style="margin-left:175px;float: left;"><label>Area Code</label></div>
                        <div style="margin-left:60px;float: left;"><label>Local Number</label></div>
                     </div>
                     <div style="clear: both;">
                         <div style="float: left; padding-top:5px;">{include file='account/lib/countries.tpl'}</div>
                         <div style="float: left;"><input type="hidden" name="countryCode" value="{$fp->countryCode|escape}"/></div>
                         <div style="float: left;"><input type="text" id="area_code_container" name="area_code" value="{$fp->area_code|escape}" maxlength="7" size="12"
                                   onclick="checkAddressMatch(this.form.email.value,this.form.verify_email.value)"/></div>
                         <div style="float: left;"><input type="text" id="local_number_container" name="local_number" value="{$fp->local_number|escape}" maxlength="9" size="13"
                                   onselect="this.form.area_code.value=stripZero(this.form.area_code.value)"/></div>
                                {include file='lib/error.tpl' error=$fp->getError('local_number')}   
		     </div>
                     <div>
			<span style="float:left; padding-top:3px; color:#FF0000;" id="displayMobile"></span>
			<span style="float:left; padding-top:3px; font-weight:bold;" id="displayMobileOK"></span>
		     </div><br/><br/>	

             </fieldset>
             <fieldset>

		<legend><b>Registration Details</b></legend>
		<div>&nbsp;</div>	
		
		<div>
			<label style="float:left">Have you felt suicidal in the last week?</label>				
			<div style="float:right">
				<input type="radio" name="screen_radio" value="Yes"/> Yes
				&nbsp;
				<input type="radio" name="screen_radio" value="No" checked="checked"/> No
			</div>
			<br></br>
		</div>

		<div id="regSpacer"></div>
		
		<div>					
	   	        <label style="float:left">Have you read the <a>terms and conditions</a>?</label>
			<div style="float:right">
				<input type="radio" name="tandc_radio" value="Yes" onclick="updateMobileNumber(this.form.countryCode.value,this.form.area_code.value,this.form.local_number.value)"/> Yes
				&nbsp;
				<input type="radio" name="tandc_radio" value="No" checked="checked"/> No
			</div>
			<br></br>
           		<input type="hidden" name="tandc" value="yes"/> {include file='lib/error.tpl' error=$fp->getError('tandc')}	
		</div>	
				
	</fieldset>
	<fieldset>
		
        <legend><b>Therapist</b></legend>
        <div>&nbsp;</div>
		
                <div>		
		     {if $sme}
		          <label style="float:left">You have currently selected <b>{$sme|escape}</b> as your therapist. Click <a href="/sme/view">here</a> to change.</label>           
	 	     {else}
		         <label style="float:left">You have currently not selected a therapist. Click <a href="/sme/view">here</a> to view therapists.</label>           
	             {/if}		
		</div>
	
                <div><input type="hidden" name="sme" value="yes"/> {include file='lib/error.tpl' error=$fp->getError('sme')}</div>	

	</fieldset>
	<fieldset>
	<legend><b>CAPTCHA</b></legend>
		<div>&nbsp;</div>
		<div>
			<img src="/utility/captcha" alt="CAPTCHA image" class="captcha"/>
		</div>
		<div><label class="captcha"><a href="http://en.wikipedia.org/wiki/CAPTCHA">What's this?</a></label></div>
		<div class="row" id="form_captcha_container">
			<label for="form_captcha">Enter Phrase Shown </label>
			<input type="text" id="form_captcha"
				name="captcha" value="{$fp->captcha|escape}" />
{include file='lib/error.tpl' error=$fp->getError('captcha')}
		</div>

	</fieldset>
	<fieldset>
	<legend><b>Story</b></legend>
		<div><label>Please fully describe the concerns for which you are seeking counselling.</label></div>	
		<div>
		<textarea class="textarea" name="story" cols="60" rows="10"></textarea>
{include file='lib/error.tpl' error=$fp->getError('story')}
		</div>		
		<div>&nbsp;</div>		
		<div class="submit" align="center">
			<input type="submit" value="Register" />
		</div>
	</fieldset>
	
</form>	
<script type="text/javascript" src="/js/UserRegistrationForm.class.js"></script>
<script type="text/javascript">
    new UserRegistrationForm('registrationform');
</script>
</div>
<!--close div for content is in sidebar-->
{include file='sidebar.tpl'}
{include file='footer.tpl'}
