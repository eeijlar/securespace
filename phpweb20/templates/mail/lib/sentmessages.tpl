<div id="content">
	<div id="mainContentWide">
{if $totalMessages eq 0}
    <div id="outlineBorder">
	<div id="sessionSpacer"></div>
    <label id="margin">
         You have no sent messages.
    </label>
    </div>
{else}		
		  {foreach from=$messages item=message}
		    <div style="border-left :solid 1px #AEC4DE; border-right :solid 1px #AEC4DE">
			<div class="inboxSpacer"></div>
			<label class="date_message">{$message->ts_created|date_format:'%d/%m/%Y %H:%M:%S'}</label>	
			<img class="mail_icon" src="/images/mail.png" alt="mail" width="20" height="20"/>
			<label class="from_message"><a href="{geturl action='view'}?id={$message->getId()}">{$message->profile->from|escape}</a></label>
			<label class="subject_message">{$message->profile->subject|escape}</label> 			
		    </div>
		  {/foreach}
		  <div id ="inboxSpacer" style="border-left :solid 1px #AEC4DE; border-right :solid 1px #AEC4DE"></div>	
		  <div style="border-bottom :solid 1px #AEC4DE"></div>		  	
{/if}

</div><!--mainContentWide-->
</div><!--content-->