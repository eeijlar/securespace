<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <title>Secure Counselling</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
        <link rel="stylesheet" type="text/css" href="/css/login.css" media="all"/>
        <script type ="text/javascript" src="/js/prototype.js"></script>
        <script type="text/javascript" src="/js/CheckRegistrationForm.js"></script>
        <script type ="text/javascript" src="/js/scriptaculous/scriptaculous.js"></script>
        </head>
        <body  onload="updateCountryPhoneCodeOnChangeInit();">  
<div id="wrap">
  <!-- start of container -->
    <!-- left column, contains navigation and photos -->

    <!-- end of left column -->
    <!-- right column, this is the main content area, and where the links are -->
    <div id="content">
      <div id="column5">
            {if $authenticated}
             <h4>Secure Counselling</h4>
             	<div>&nbsp;</div>
                <label style="float:left">| <a href="/account">Your Account</a>
                 | <a href="/profile/view">Profile</a>
                 </label>
                {if $identity->user_type == 'administrator'}
                <label style="float:left">| <a href="/admin">Administration</a></label>
                <label style="float:right">Status: {$identity->user_type|capitalize|escape}</label>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                {else}
                <div>&nbsp;</div>   
                <div>&nbsp;</div>        
                {/if}
                
            {else}
            {/if}

            {if $authenticated}
                    <label style="float:right">Logged in as {$identity->first_name|escape} {$identity->last_name|escape}
                    (<a href="/account/logout">logout</a>)</label>
            {/if}
