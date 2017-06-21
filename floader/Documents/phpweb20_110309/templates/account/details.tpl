{include file='login_header.tpl' section='account'}
{include file='profile/lib/mail.tpl'}

<div class="margin">
<form method="post" action="{geturl action='details'}">
	<div id = "inboxHeader"></div>
    <legend><b>Update Your Details</b></legend>

    {if $fp->hasError()}
        <div class="error">
            An error has occurred in the form below. Please check
            the highlighted fields and re-submit the form.
        </div>
    {/if}

    <p>
        To change your account password, enter a new password below.
        If you leave this field blank your password will remain
        unchanged.
    </p>

    <div class="row" id="form_email_container">
        <label for="form_email">E-mail Address:</label>
        <input type="text" id="form_email"
               name="email" value="{$fp->email|escape}" />
        {include file='lib/error.tpl' error=$fp->getError('email')}
    </div>

    <div class="row" id="form_first_name_container">
        <label for="form_first_name">First Name:</label>
        <input type="text" id="form_first_name"
               name="first_name" value="{$fp->first_name|escape}" />
        {include file='lib/error.tpl' error=$fp->getError('first_name')}
    </div>

    <div class="row" id="form_last_name_container">
        <label for="form_last_name">Last Name:</label>
        <input type="text" id="form_last_name"
               name="last_name" value="{$fp->last_name|escape}" />
        {include file='lib/error.tpl' error=$fp->getError('last_name')}
    </div>

    <div class="row" id="form_password_container">
        <label for="form_password">Password:</label>
        <input type="password" id="form_password"
               name="password" value="{$fp->password|escape}" />
        {include file='lib/error.tpl' error=$fp->getError('password')}
    </div>

    <div class="row" id="form_password_confirm_container">
        <label for="form_password_confirm">Retype Password:</label>
        <input type="password" id="form_password_confirm"
               name="password_confirm" value="{$fp->password_confirm|escape}" />
        {include file='lib/error.tpl' error=$fp->getError('password_confirm')}
    </div>   
    
    <div class="submit">
    	<input class="customLogin" type="submit" value="Save" />
	</div>
</form>
</div>
</div>
{include file='footer.tpl'}