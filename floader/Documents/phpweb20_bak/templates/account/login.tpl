{include file='header.tpl'}

<form method="post" action="/account/login">
    <fieldset>
        <legend><b>Login To Your {$website|escape} Account</b></legend>              
  		<input type="hidden" name="redirect" value="{$redirect|escape}" />
		<div>&nbsp;</div>
		<a href="/account/fetchpassword">Forgotten your password?</a>
		<div>&nbsp;</div>
		<div><p>If you are not yet registered with {$website|escape}, you can register <a href="/sme/view">here</a></div>

        <div class="row" id="form_username_container">
            <label for="form_username">Username</label>
            <input type="text" id="form_username"
                   name="username" value="{$username|escape}" maxlength="15"/>
            
        </div>

        <div class="row" id="form_password_container">
            <label for="form_password">Password</label>
            <input type="password" id="form_password"
                   name="password" value="" maxlength="8"/>
            {include file='lib/error.tpl' error=$errors.username}
            {include file='lib/error.tpl' error=$errors.password}
        </div>

        <div class="row" id="password_error_container">
            {include file='lib/error.tpl' error=$errors.certificate}
        </div>

        <div>
            <input class="customLogin" type="submit" value="Login"/>
			<img src="/images/padlock_sml.png" alt="padlock" width="20" height="25"/>
        </div>
		<div>&nbsp;</div>		
		<div><p>Please note that you will not be able to log in until your application has been reviewed by one of our therapists. You will receive a text message when your application has been processed</p></div>
    </fieldset>
</form>

{include file='disclaimer.tpl'}

{include file='footer.tpl'}