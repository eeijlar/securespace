{include file='login_header.tpl'}
{include file='profile/lib/mail.tpl'}
<div class="margin">
	<p>{$message|escape}</b>
		<div id="inboxHeader"></div>
		<label><b>Your profile picture</b></label>
		<div id="inboxHeader"></div>
		<p>
	    	<img src="{imagefilename id=$user_id w=200 h=65}" alt="{$alt}"/>
	    </p>
	 </div> 
 </div>
{include file='footer.tpl'}