		  <div id="outlineBorder">
		  <div id="sessionSpacer"></div>		  
			  <label id="margin">
			  {if $totalMessages eq 0}
			  	There are no new messages in your inbox.		
			  {elseif $totalMessages gt 1}
			  	You have <b>{$totalMessages|escape}</b> new messages
			  {else}	
			    You have <b>{$totalMessages|escape}</b> new message
			  {/if}	
			  </label>
			  <div id="inboxHeader"></div>
		
		  {foreach from=$messages item=message}
			<div class="inboxSpacer"></div>
			{if $message->message_status eq 'New'}
			<b><label class="date_message">{$message->ts_created|date_format:'%d/%m/%Y %H:%M:%S'}</label>	
			<img class="mail_icon" src="/images/mail_receive.png" alt="mail" width="20" height="20"/>
			<label class="from_message"><a href="{geturl action='view'}?id={$message->getId()}">{$message->profile->from|escape}</a></label>
			<label class="subject_message">{$message->profile->subject|escape}</label>  
			</b>
			{else}
			<label class="date_message">{$message->ts_created|date_format:'%d/%m/%Y %H:%M:%S'}</label>	
			<img class="mail_icon" src="/images/mail.png" alt="mail" width="20" height="20"/>
			<label class="from_message"><a href="{geturl action='view'}?id={$message->getId()}">{$message->profile->from|escape}</a></label>
			<label class="subject_message">{$message->profile->subject|escape}</label> 
			{/if}		
		  {/foreach}
		   </div>
