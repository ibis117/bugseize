<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Api key
    |--------------------------------------------------------------------------
    |
    | This is your authorization key which you get from when you create a project.
    |
    |
    */

    'token' => env('BS_ACCESS_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | Environment setting
    |--------------------------------------------------------------------------
    |
    | This setting determines if the exception should be sent over or not.
    |
    */

    'environments' => [
        'production',
        'local',
    ],

    /*
    |--------------------------------------------------------------------------
    | Project version
    |--------------------------------------------------------------------------
    |
    |Sets the composer version of the package ibis117/bugseize
    |
    */
    'version' => \Composer\InstalledVersions::getVersion('ibis117/bugseize'),

    /*
    |--------------------------------------------------------------------------
    | Lines near exception
    |--------------------------------------------------------------------------
    |
    | How many lines to show near exception line. The more you specify the bigger
    | the displayed code will be. Max value can be 50, will be defaulted to
    | 12 if higher than 50 automatically.
    |
    */

    'lines_count' => env('BS_LINE_COUNT', 12),

    /*
    |--------------------------------------------------------------------------
    | Prevent duplicates
    |--------------------------------------------------------------------------
    |
    | Set the sleep time between duplicate exceptions. This value is in seconds, default: 60 seconds (1 minute)
    |
    */

    'sleep' => 60,

    /*
    |--------------------------------------------------------------------------
    | Set Timeout for Http Call
    |--------------------------------------------------------------------------
    |
    | Set The Timeout For reporting Exception
    |
    */

    'timeout' => 60,

    /*
    |--------------------------------------------------------------------------
    | Skip exceptions
    |--------------------------------------------------------------------------
    |
    | List of exceptions to skip sending.
    |
    */

    'except' => [
        'Symfony\Component\HttpKernel\Exception\NotFoundHttpException',
    ],

    /*
    |--------------------------------------------------------------------------
    | Key filtering
    |--------------------------------------------------------------------------
    |
    | Filter out these variables before sending them to LaraBug
    |
    */

    'blacklist' => [
        '*authorization*',
        '*password*',
        '*token*',
        '*auth*',
        '*verification*',
        '*credit_card*',
        'cardToken',
        '*cvv*',
        '*iban*',
        '*name*',
        '*email*'
    ],

    /*
    |--------------------------------------------------------------------------
    | Release git hash
    |--------------------------------------------------------------------------
    |
    |
    */

    // 'release' => trim(exec('git --git-dir ' . base_path('.git') . ' log --pretty="%h" -n1 HEAD')),

    /*
    |--------------------------------------------------------------------------
    | Server setting
    |--------------------------------------------------------------------------
    |
    | This setting allows you to change the server.
    |
    */

    'url' => env('BS_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Verify SSL setting
    |--------------------------------------------------------------------------
    |
    | Enables / disables the SSL verification when sending exceptions to LaraBug
    | Never turn SSL verification off on production instances
    |
    */
//    'verify_ssl' => env('LB_VERIFY_SSL', true),

];
