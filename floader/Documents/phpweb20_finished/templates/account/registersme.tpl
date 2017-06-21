{include file='sme_header.tpl'}
{include file='admin.tpl'}
<div class = "mailSpacer"></div>

<form  method="post" action="/account/registersme" id="registrationform" name="registration">
	<fieldset>
		<legend>Create SME Account</legend>
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
				onclick="isValidLastName(this.form.last_name.value);"/>
			<span style="color:#FF0000;" id="usernameerror"></span>	
			{include file='lib/error.tpl' error=$fp->getError('username')}
		</div>

		<div class="row" id="form_email_container">
			<label for="form_email">E-mail Address</label>
			<input type="text" id="form_email"
				name="email" value="{$fp->email|escape}" maxlength="30"
				onclick="isValidUserName(this.form.username.value);"/>		
			<span style="color:#FF0000;" id="emailerror"></span>	
			{include file='lib/error.tpl' error=$fp->getError('email')}
		</div>

		<div class="row" id="form_verifyemail_container">
			<label for="form_email">Verify E-mail Address</label>
			<input type="text" id="form_email_verify"
				name="verify_email" value="{$fp->verify_email|escape}" maxlength="30"
				onclick="isValidEmail(this.form.email.value);"/>
			<span style="color:#FF0000;" id="verifyemailerror"></span>	
			{include file='lib/error.tpl' error=$fp->getError('verify_email')}
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
	           	<li class="inline">{include file='account/lib/countries.tpl'}
	           			<input type="hidden" name="countryCode" value="{$fp->countryCode|escape}"/></li>	           				
	            <li class="inline"><input type="text" id="area_code_container"
	        	           name="area_code" value="{$fp->area_code|escape}" maxlength="7" size="12"
	        	           onclick="checkAddressMatch(this.form.email.value,this.form.verify_email.value)"/>
	        	 </li>
	            <li class="inline"><input type="text" id="local_number_container"
	        	           name="local_number" value="{$fp->local_number|escape}" maxlength="9" size="13"
	        	           onselect="this.form.area_code.value=stripZero(this.form.area_code.value)"/>
				{include file='lib/error.tpl' error=$fp->getError('local_number')}</li>        	           
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
				{include file='lib/error.tpl' error=$fp->getError('smeprofile')}
			</div>	
			<div>&nbsp;</div>		
			<div class="submit" align="center">
				<input type="submit" value="Register" />
			</div>			
		</fieldset>
</form>

{include file='footer.tpl'}
