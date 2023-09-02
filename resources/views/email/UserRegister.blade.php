<x-mail::message>
    Bonjour {{ $name }}
    <h4>Votre compte a été crée avec success</h4>
    <h4>Voici vos identifiant</h4>
    <P>Email: {{ $email }}</p>
    <P>Mot de passe: password</p>
    <P>NB: ce mot de passe est temporaire il dois etre changé a votre première connexion</p>
    Merci,
    {{ config('app.name') }}
</x-mail::message>