{include file='login_header.tpl'}
{include file='admin.tpl'}
<br>
<p>
  Registration for {$user->profile->first_name|escape} {$user->profile->last_name|escape}  is now complete.
</p>

<p>
    Please inform the user, that their user name and password has been mailed to the following address: {$user->profile->email|escape}.
</p>

{include file='footer.tpl'}