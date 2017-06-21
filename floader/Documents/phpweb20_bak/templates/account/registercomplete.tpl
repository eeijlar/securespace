{include file='client_header.tpl' active='register'}

<p>
    Thank you {$user->profile->first_name|escape},
    your registration is now complete.
</p>

<p>
    Your password has been e-mailed to you at {$user->profile->email|escape}. When we
    have processed your application you will receive a text message and an e-mail with your digital 
    certificate attached.
</p>

<div class="bigSpacer"></div>

{include file='footer.tpl'}