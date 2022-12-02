<x-mail::message>
Bonjour {{ $nom_admin }}

Voici la liste des demandes qui ne sont toujours pas prises en charge <br>
@foreach ($demandes as $demande)
    <a href="{{ route('admin.demande',$demande->id) }}">
        {{$demande->objet}}
    </a><br>
@endforeach
<br>
Veuillez les consulter des que possible


Cordialement,<br>
{{ config('app.name') }}
</x-mail::message>
