<x-mail::message>
# Bonjour {{ $nom }}
{{ $objet }}
The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
