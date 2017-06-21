{include file='login_header.tpl'}
{include file='mail.tpl'}
<div id="spacer"></div>
<div id="outlineBorder">
<p>Sorry, {$identity->first_name|escape}. 
Your payment has failed to process. </p>
</div>
{include file='footer.tpl'}