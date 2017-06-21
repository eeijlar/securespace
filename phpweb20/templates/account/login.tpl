{include file='header.tpl'}
<div id="content">    
{include file='sidebar.tpl'}      
<div id="mainContent">
<form method="post" action="/account/login">
    <fieldset>
        <legend><b>Login To Your {$website|escape} Account</b></legend>              
  		<input type="hidden" name="redirect" value="{$redirect|escape}" />
		<div class="row"><p>If you are not yet registered, you can register <a href="/sme/view">here</a></div>

        <div class="row" id="form_username_container">
            <label for="form_username"><b>Username</b></label>
            <input type="text" id="form_username"
                   name="username" value="{$username|escape}" maxlength="15"/>
        </div>

        <div class="row" id="form_password_container">
            <label for="form_password"><b>Password</b></label>
            <input style="margin-left:12px" type="password" id="form_password"
                   name="password" value="" maxlength="8"/>
            {include file='lib/error.tpl' error=$errors.username}
            {include file='lib/error.tpl' error=$errors.password}
        </div>

        <div class="row" id="password_error_container">
            {include file='lib/error.tpl' error=$errors.certificate}
        </div>

        <div>
            <input class="customLogin" type="submit" value="Login"/>
                <a href="/account/fetchpassword">Forgotten your password?</a>
        </div>
    </fieldset>
</form>
{include file='disclaimer.tpl'}
{include file='footer.tpl'}
