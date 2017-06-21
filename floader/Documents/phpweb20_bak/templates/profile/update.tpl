{include file='login_header.tpl'}
{include file='profile/lib/mail.tpl'}
	<div class="margin"><br/>
	<form method="post" action="/profile/update">
		<label><b>Your current profile</b></label>
		<div class="mailSpacer"></div>
		{if $smeprofile}
		<textarea class="textarea" name="smeprofile" cols="65" rows="10">{$smeprofile|escape}
		</textarea>
		{else}
		<textarea class="textarea" name="smeprofile" cols="65" rows="10"></textarea>		
		{/if}
		<div class="mailSpacer"></div>
		<div class="submit">
			<input type="submit" value="Update" />
		</div>
	</form>
	</div>
</div>

{include file='footer.tpl'}