<?php

namespace Qanna\Guardian\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\Mail;
use Qanna\Guardian\Tests\TestModels\User;

class SendNotificationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_send_an_email_if_password_is_changed()
    {

        Mail::fake();

        $user = User::factory()->create();
        $user->password = bcrypt('password');
        $user->save();

        Mail::assertSent($user->passwordChangedNotificationMail()::class);
    }

    #[Test]
    public function wont_send_an_email_if_password_has_not_been_changed()
    {
        Mail::fake();

        $user = User::factory()->create();
        $user->name = fake()->name();
        $user->save();

        Mail::assertNotSent($user->passwordChangedNotificationMail()::class);
    }
}