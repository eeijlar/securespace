{include file='login_header.tpl'}
{include file='admin.tpl'}

<div id = "spacer">
</div>
<form  action="/sme/process" method="post">
		{foreach from=$smes item=sme}
			<div id="mailHeader">		
			<div id="inboxHeader"></div>
			<div id = "regSpacer"></div>
			<label id ="margin"><b>Name</b></label>
		 	<label id ="margin" name="client">{$sme.name|capitalize|escape}</label>
		 	<div id = "regSpacer"></div>
		 	<label id ="margin"><b>Status</b></label>
		 	<label id ="margin">{$sme.status|escape}</label>
		 	<div id = "regSpacer"></div>
		 	{if $sme.status eq 'Processed'}
		 	<div id="navigation">
			<li><a href="/sme/process?id={$sme.user_id|escape}&action=accept">Accept</a></li>
			<li><a href="/sme/process?id={$sme.user_id|escape}&action=reject">Reject</a></li>
			</div>
			<br>
		 	{/if}
		 	</div>
		{/foreach}	
		  <div id="mailHeader">
		  <div id="mailFooter"></div>
</form>		  

{include file='footer.tpl'}