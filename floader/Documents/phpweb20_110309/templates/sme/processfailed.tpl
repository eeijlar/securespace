{include file='login_header.tpl'}
{include file='mail.tpl'}
    <div id="outlineBorder">
	<div id="regSpacer"></div>
    <p id="margin">
         Your request to {$action|escape} client {$name|escape} has failed.<br>
         It failed with error: {$error|escape}<br>
         Please notify the system administrator with details of the error.    
    </p>
    </div>
{include file='footer.tpl'}