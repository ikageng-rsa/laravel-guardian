<?php

return [

    /**
     * 
     * Send an email notification when user password has been changed
     * 
     */
    'notify' => true,

    'que_notifications' => false,

    'database' => [
        'password_column_name' => 'password',
        'email_column_name' => 'email'
    ],
];