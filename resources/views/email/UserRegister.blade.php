<x-mail::message>
    Bonjour {{ $name }}
    <h4>Votre compte a été crée avec success</h4>
    <h6>Voici vos identifiant</h6>
    <h6>Email: {{ $email }}</h6>
    <h6>Mot de passe: password</h6>
    <h6>NB: ce mot de passe est temporaire il dois etre changé a votre première connexion</h6>
    Merci,<br>
    {{ config('app.name') }}
</x-mail::message>