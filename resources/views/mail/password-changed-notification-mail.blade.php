<x-mail::message>
    # Password Changed

    Hello {{$user->name}}

    Your {{ config('app.name') }} account password was recently changed.

    If this wasn't you, please contact the {{ config('app.name') }} team as soon as possible.

    <x-mail::button :url="config('app.url')">
        Go to login
    </x-mail::button>

    Thanks, <br>
    {{ config('app.name') }}
</x-mail::message>

