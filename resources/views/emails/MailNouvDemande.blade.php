<x-mail::message>
# Bonjour {{ $nom }} <br>

nouvelle demande disponible
<br>


<h1 > <u>{{$objet}}</u></h1>
<br>
{{$contenu}}
<br>
<br>
aller dans votre page pour gerer la demande

<br>
<a href="{{ route('welcome') }}">
 assistancia
</a>

<x-mail::button :url="''">
voir
</x-mail::button>

merci,<br>
{{ config('app.name') }}
</x-mail::message>
