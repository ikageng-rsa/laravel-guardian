<?php

namespace Qanna\Guardian\Traits;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Qanna\Guardian\Mail\PasswordChangedNotificationMail;
use Qanna\Guardian\Observers\PasswordObserver;

trait HasGuardian
{
    public static function booted()
    {
        static::observe(PasswordObserver::class);
    }

    /**
     * Returns a mail object
     * 
     * @return Illuminate\Mail\Mailable;
     */
    public function passwordChangedNotificationMail(): Mailable
    {
        return new PasswordChangedNotificationMail;
    }

    private function passwordChanged(): bool
    {
        return $this->wasChanged(config('guardian.database.password_column_name'));
    }

    private function shouldPasswordNotificationBeQueued(): bool
    {
        return config('guardian.que_notifications', false);
    }

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