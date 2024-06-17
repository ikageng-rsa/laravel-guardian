<?php

namespace Qanna\PasswordMonitor\Observers;

use Illuminate\Support\Facades\Mail;
use Qanna\PasswordMonitor\Mail\PasswordChangedNotificationMail;

class PasswordObserver
{
    public function updated($model)
    {
        if($model->wasChanged('password'))
        {
            if(config('password_monitor.notify'))
                Mail::to($model->email)->send(new PasswordChangedNotificationMail);
        }
    }
}