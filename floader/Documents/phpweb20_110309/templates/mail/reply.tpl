{include file='login_header.tpl'}
{include file='mail.tpl'}

    {if ($credits == 0 and $user_type eq 'member')}
    <div id = "outlineBorder">
   	{include file='paypal.tpl'}
   	</div>	
    {else}
    	<div id="inboxHeader"></div>
    	<form  action="/mail/reply" method="post">
    	<div>
        	<b><label for="form_subject">To</label></b>
         	<label for="form_subject">{$identity->name|escape}</label>
    	</div>
    	<div id = "inboxHeader"></div>
    	 <div>
        	<b><label for="form_subject">Subject</label></b>
        	<label>Re: {$identity->subject|escape}</label>
    	</div>
    	<div id = "inboxHeader"></div>
		<div>
   		{wysiwyg name='body'}
   		</div>
   		<div id = "inboxHeader"></div>
   		<div class="submit" align="left">
			<input type="submit" value="Send" />
		</div>
		</form>
    {/if}
  
{include file='footer.tpl'}
