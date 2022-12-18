<x-mail::message>
Bonjour {{ $nom_admin }}

Vos demandes ci dessous ne sont pas encore traitées:
<br>
@foreach ($demandes as $demande)
    <a href="{{ route('admin.demande',$demande->id) }}">
        {{$demande->objet}}
    </a>
    <br>
@endforeach
<br>
Veuillez les traiter ou les rejeter le plus tot possible.

Cordialement,<br>
{{ config('app.name') }}
</x-mail::message>
