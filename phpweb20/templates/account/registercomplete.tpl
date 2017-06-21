{include file='login_header.tpl' active='register'}

<p>
    Thank you {$user->profile->first_name|escape},
    your registration is now complete.
</p>

<p>
    Your login information has been e-mailed to you at {$user->profile->email|escape}. 
</p>
<br />
<p>
    <a href="http://www.securecounselling.ie">Return to Secure Counselling</a>
</p>

<div class="bigSpacer"></div>

{include file='footer.tpl'}
