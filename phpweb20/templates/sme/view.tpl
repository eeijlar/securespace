{include file='header.tpl'}
<div id="content">
	<div id="mainContent">
<form method="post" action="/account/register">
		<h3>Meet Our Therapists</h3>
		<div class = "mailSpacer"></div>	
	
		{foreach from=$smes item=sme}
			<fieldset>
				<div class = "margin">
					<div>
				 		<img src="{imagefilename id=$sme.user_id w=200 h=65}" alt="Profile Picture" class="imageRight" />
				 	</div>
					 	<p><b>{$sme.name|capitalize|escape}</b></p>
					 	<p>{$sme.smeprofile|escape}</p>
					 			 	
				</div>
			</fieldset>		
					<div id="navigation">
                                            <li>
                                               <a href="/account/register?sme={$sme.user_id|escape}">Select</a>
                                            </li>
                                            <br></br>
                                        </div>
					
			<br></br>
		{/foreach}

</form>
</div><!--maincontent-->
{include file='sidebar.tpl'}
{include file='footer.tpl'}
