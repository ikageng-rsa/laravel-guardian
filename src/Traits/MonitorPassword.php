<?php

namespace Qanna\PasswordMonitor\Traits;

use Qanna\PasswordMonitor\Observers\PasswordObserver;

trait MonitorPassword
{
    public static function booted()
    {
        static::observe(PasswordObserver::class);
    }
}