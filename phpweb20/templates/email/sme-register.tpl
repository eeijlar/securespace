{$user->profile->first_name}, Thank You For Your Registration
Dear {$user->profile->first_name},

You have now registered as a therapist with {$website|escape}. Your username and password for your account are:

    Username: {$user->username}
    Password: {$user->_newPassword}

To log on choose the option "login" or follow the link: {$url|escape}/account/login


Yours sincerely,

{$website|escape} Administration
