<div>
<label>Welcome, {$identity->first_name|escape} </label>
</div>
<div class = "mailSpacer"></div>
{if $user_type eq 'member'}

<div>
	<label style="float:left;">Therapist: <b>{$identity->sme|escape} </b></label>
	<label style="float:right;">Credits: <b>{$identity->credits|escape}</b></label>
</div>

<div class = "inboxSpacer"></div>
<div class = "inboxSpacer"></div>
<div class = "inboxSpacer"></div>
<div class = "inboxSpacer"></div>
<div class = "inboxSpacer"></div>

{/if}
<div id="navigation">
<ul>
{if $identity->newMessages}
<li id="inboxSelected"><a href="/mail/inbox">Inbox <b>({$identity->newMessages|escape})</b></a></li>
{else}
<li id="inboxSelected"><a href="/mail/inbox">Inbox</a></li>
{/if}
<li><a href="/mail/sent">Sent Items</a></li>
{if $user_type ne 'member'}
<li><a href="/sme/clients">Clients</a></li>
<li><a href="/mail/newmessage" class="sme_message">Write Message</a></li>
{else}
<li><a href="/mail/newmessage" class="message">Write Message</a></li>
{/if}
</ul>
</div>
<div id="inboxBorder">
</div>
