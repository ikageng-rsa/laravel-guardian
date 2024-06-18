<?php

namespace Qanna\Guardian\Observers;

class PasswordObserver
{
    public function updated($model)
    {
        $model->sendPasswordNotification();
    }
}