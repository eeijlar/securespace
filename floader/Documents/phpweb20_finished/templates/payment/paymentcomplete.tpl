{include file='login_header.tpl'}
{include file='mail.tpl'}
<div id="spacer"></div>
<div id="outlineBorder">
<label id="margin">Thank you, {$identity->first_name|escape}. 
Your payment has been processed successfully.</label><br> 
<label id="margin">Select 'Write Message' to send a message to your therapist. </label>

<p>{$txDetails|escape}</p>

</div>
{include file='footer.tpl'}