<?php

namespace Qanna\Guardian\Traits;

use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Mail\PendingMail;
use Illuminate\Support\Facades\Mail;
use Qanna\Guardian\Mail\PasswordChangedNotificationMail;
use Qanna\Guardian\Observers\PasswordObserver;

trait HasGuardian
{
    public static function booted()
    {
        static::updated(function($user) {
            $user->sendPasswordNotification();
        });
    }

    /**
     * Returns a mailable obkect
     * 
     * @return \Illuminate\Contracts\Mail\Mailable
     */
    public function passwordChangedNotificationMail(): Mailable
    {
        return new PasswordChangedNotificationMail($this);
    }


    /**
     * Checks if the password has been chanhed
     * 
     * @return bool
     */
    private function passwordChanged(): bool
    {
        return $this->wasChanged(config('guardian.database.password_column_name'));
    }

    /**
     * Returns a configuration setting to que notifications
     * 
     * @return bool
     */
    private function shouldPasswordNotificationBeQueued(): bool
    {
        return config('guardian.que_notifications', false);
    }

    /**
     * Sends a notification if conditions are met
     * 
     * @return null|\Illuminate\Mail\PendingMail
     */
    public function sendPasswordNotification()
    {
        if(!config('guardian.notify', false))
        {
            return;
        }
        
        if(!$this->passwordChanged()) 
        {  
            return;
        }

        $mail = Mail::to(
            $this->getRawOriginal(config('guardian.database.email_column_name'))
        );


        if($this->shouldPasswordNotificationBeQueued())
        {
            return $mail->queue($this->passwordChangedNotificationMail());
        }

        
        return $mail->send($this->passwordChangedNotificationMail());
    }
}