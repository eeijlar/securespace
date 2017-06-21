{include file='login_header.tpl'}
{include file='mail.tpl'}
<div id="content">
	<div id="mainContentWide">
    {if ($credits == 0 and $user_type eq 'member')}
    <div id="outlineBorder">
    <div id="inboxHeader"></div>
   	{include file='paypal.tpl'}	
    </div>
    {else}
    	{if $noclients}
    	    <div id="outlineBorder">
			    <div id="inboxHeader"></div>
	    		<div class="margin">
	    			<p>You currently have no active clients. Check the 'Clients' tab and accept a client.</p>
	    		</div>
    		</div>
    	{else}
	    	<form  action="/mail/newmessage" method="post">
	    	{if $user_type eq 'sme' || $user_type eq 'administrator'}
	    	    <div class="row" id="form_subject_container">
	        	<label for="form_subject">To</label>
	         	<dd>
	            	<select name="client">
	               	  {foreach from=$clients item=client}
			 			 <option value="{$client.name}"
	                  	{if !$fp->client} selected="selected"{/if}>{$client.name|capitalize|escape}</option>
					  {/foreach}
	            	</select>
	        	</dd>
	    	</div>
	    	{/if}
	    	 <div class="row" id="form_subject_container">
	        	<label for="form_subject">Subject</label>
	        	<input type="text" id="form_subject"
	               name="subject" value="{$fp->subject|escape}" />
	            {include file='lib/error.tpl' error=$fp->getError('subject')}
	    	</div>
			<div>
	   		{wysiwyg name='body' value=$fp->body}
	   		{include file='lib/error.tpl' error=$fp->getError('body')}
	   		</div>
	   		<div class="submit" align="left">
				<input type="submit" value="Send" />
			</div>
			</form>
		{/if}	
    {/if}

</div></div>

{include file='footer.tpl'}