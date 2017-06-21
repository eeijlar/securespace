{include file='login_header.tpl'}
{include file='mail.tpl'}
<div id="spacer"></div>
<div id="outlineBorder">

<label id="margin">Thank you, {$identity->first_name|escape}. 
Your message has been successfully sent to your {$recipient|escape}.</label>
</div>
{include file='footer.tpl'}