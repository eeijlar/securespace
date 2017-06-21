{include file='login_header.tpl'}
{include file='mail.tpl'}
<div id="outlineBorder">
<p>Sorry, {$identity->first_name|escape}. 
Your payment has been cancelled. </p>
</div>
{include file='footer.tpl'}