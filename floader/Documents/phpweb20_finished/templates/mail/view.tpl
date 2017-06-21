{include file='login_header.tpl'}
{include file='mail.tpl'}
<div id="content">
	<div id="mainContentWide">

<div id="spacer"></div>
	<form action="/mail/reply" method="post">
<div id="outlineBorder">
    <div id="padding">
    <div><label><b>From:</b> {$profile->from|escape}</label></div>	
    <div id = "inboxHeader"></div>
    <div><label><b>To:</b> {$profile->to|escape}</label></div>
    <div id = "inboxHeader"></div>	
    <div><label>{$body|escape}</label></div>	
    </div>
    <div id = "inboxHeader"></div>
    <div id = "inboxHeader"></div>
    <div id = "inboxHeader"></div>
    <div id = "inboxHeader"></div>
    <div id = "inboxHeader"></div>
    <div id = "inboxHeader"></div>
    
</div>
	<div class="submit" align="left">
	<input type="submit" value="Reply" />
	</div>
	</form>
</div><!--maincontentwide-->
</div><!--content-->
{include file='footer.tpl'}