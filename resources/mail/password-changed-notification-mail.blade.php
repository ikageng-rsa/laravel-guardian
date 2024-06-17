<x-mail::message>
# Password Changed

Your {{ config('app.name') }} account password was recently changed.

If this wasn't you, please contact {{ config('app.name') }} team as soon as possible.


<x-mail::button :url="{{ config('app.url') }}/login">
Go to login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
