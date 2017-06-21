{include file='login_header.tpl'}
{include file='profile/lib/mail.tpl'}
{if $user_type ne 'member'}
		<div class="margin">
			<label><b>Your current profile picture</b></label>
			<div class="mailSpacer"></div>
			<p>
		      <img src="{imagefilename id=$user_id w=400 h=100}" alt="{$alt}"/>
		   	</p>
		   	<div class="mailSpacer"></div>
		   	<form method="post"
		          action="/profile/upload"
		          enctype="multipart/form-data">
		
		        <div>
		            <input type="submit" value="Upload" name="upload"/>
		            <input type="file" name="image"/> 
		        </div>
		    </form>
	  </div>
 </div> 
{else}
<div id="inboxBorder">
</div>
</div>
{/if}

{include file='footer.tpl'}