{include file='login_header.tpl' section='account'}
{include file='profile/lib/mail.tpl'}
	<p id="margin">
	    Thank you {$user->profile->first_name|escape},
	    your details have been updated.
	</p>
</div>
{include file='footer.tpl'}