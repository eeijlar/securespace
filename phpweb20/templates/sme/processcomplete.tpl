{include file='login_header.tpl'}
{include file='mail.tpl'}
<div id="content">
	<div id="mainContentWide">
    <div id="outlineBorder">
	<div id="regSpacer"></div>
    <p id="margin">
         Your request to {$action|escape} {$name|escape} has been processed successfully.<br>
         {if $action eq 'accept'}
         	Your client should now have received an e-mail confirming their application.<br>
         {else}
         	
         {/if}          
    </p>
    </div>
</div><!--maincontentwide-->
</div><!--content-->
	
{include file='footer.tpl'}
