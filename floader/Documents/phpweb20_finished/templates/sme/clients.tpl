{include file='login_header.tpl'}
{include file='mail.tpl'}
<div id="content">
	<div id="mainContentwide">
<div id = "spacer"></div>
<form  action="/sme/process" method="post">
		{foreach from=$clients item=client}
			<div class="clientsHeader">
			<div class= "margin">		
				<label><b>Name</b></label>
			 	<label>{$client.name|capitalize|escape}</label>
				<div class = "mailSpacer"></div>
			 	<label><b>Story</b></label>
			 	<label>{$client.story|escape}</label>
				<div class = "mailSpacer"></div>
			 	<label><b>Status</b></label>
			 	<label>{$client.status|escape}</label>
				<div class = "mailSpacer"></div>
			 	{if $client.status eq 'Processed'}

			 	<div id="navigation">
			 		<ul>
					<li><a href="/sme/process?id={$client.user_id|escape}&action=accept">Accept</a></li>
					<li><a href="/sme/process?id={$client.user_id|escape}&action=reject">Reject</a></li>
					</ul>
				</div>
		 		{/if}
			</div>
		 	</div>
		{/foreach}	
		<div id="mailFooter"></div>	
</form>		  	  
</div></div>
{include file='footer.tpl'}
