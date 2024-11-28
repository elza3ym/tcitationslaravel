<x-mail::message>

# Hello,

We've got a support request from user <b>{{ $fromUserName }}</b>

<x-mail::panel>
    {{ $supportSubject }}
</x-mail::panel>
<x-mail::panel>
    {{ $supportDescription }}
</x-mail::panel>

Thanks,
{{ config('app.name') }}
</x-mail::message>
