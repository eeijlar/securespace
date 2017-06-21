<div>
<label>Welcome, {$identity->first_name|escape} </label>
</div>
<div class = "mailSpacer"></div>

{if $user_type ne 'member'}
{else}
<div>
        <label style="float:left">Therapist: <b>{$identity->sme|escape} </b></label>
        <label style="float:right">Credits: <b>{$identity->credits|escape}</b></label>
</div>

<div id = "inboxHeader"></div>
<div id = "inboxHeader"></div>
<div id = "inboxHeader"></div>
<div id = "inboxHeader"></div>

{/if}
<div id="navigation">
<ul>
{if $user_type ne 'member'}
        <li id="inboxSelected"><a href="/profile/view">Profile Picture</a></li>
        <li><a href="/profile/update">Change Information</a></li>
        <li><a href="/account/details">Change Password</a></li>
{else}
        <li><a href="/account/details">Change Password</a></li>
{/if}
</ul>
</div>

<div id="inboxBorder">
</div>
<div id = "outlineBorder">
        <div class="mailSpacer"></div>

