{include file='header.tpl'}

<form method="post" action="/account/register">
		<h4>Meet Our Therapists</h4>
		<div class = "mailSpacer"></div>	
	
		{foreach from=$smes item=sme}
			<fieldset>
			<legend>{$sme.name|capitalize|escape}</legend>
				<div class = "margin">
					<div>
				 		<p>
	                    	<img src="{imagefilename id=$sme.user_id w=200 h=65}" alt="Profile Picture"/>
	                	</p>
				 	</div>
			 	
					 	<label><b>Name</b></label>
					 	<label>{$sme.name|capitalize|escape}</label>
					 	<div class = "mailSpacer"></div>	
					 	<label><b>Profile</b></label>
					 	<p>{$sme.smeprofile|escape}</p>
					 			 	
					</div>
			</fieldset>		
					<div id="navigation">
							<ul><li><a href="/account/register?sme={$sme.user_id|escape}">Select</a></li></ul>
					</div>
					
					<div class = "mailSpacer"></div>	
					<div class = "mailSpacer"></div>	
					<div class = "mailSpacer"></div>	
					<div class = "mailSpacer"></div>	
			
		{/foreach}

</form>

{include file='footer.tpl'}