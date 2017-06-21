{include file='login_header.tpl' section='account'}
{include file='profile/lib/mail.tpl'}
<div id="content">
	<div id="mainContentWide">
	<p id="margin">
	    Thank you {$user->profile->first_name|escape},
	    your details have been updated.
	</p>
</div>
</div><!--maincontentwide-->
</div><!--content-->

{include file='footer.tpl'}