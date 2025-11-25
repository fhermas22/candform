<x-mail::message>
# Bonjour {{ $first_name }} {{ $last_name }},

Nous avons bien reçu votre candidature via **{{ config('app.name') }}**.
Notre équipe prendra le soin d’étudier votre profil et vous contactera sous peu.

<x-mail::button :url="'http://127.0.0.1:8000/'">
Visiter le site {{ config('app.name') }}
</x-mail::button>

Merci pour la confiance que vous accordez à notre plateforme.
Cordialement,
**L’équipe {{ config('app.name') }}**
</x-mail::message>
