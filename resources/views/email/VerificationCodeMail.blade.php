<x-mail::message>
    <h1>Vérifiez votre adresse e-mail</h1>
    Utilisez le code suivant pour vérifier votre adresse e-mail : {{ $code }} <br>
    Si vous n’avez demandé aucun code, vous pouvez ignorer cet e-mail. Un autre utilisateur a peut-être indiqué votre
    adresse e-mail par erreur.
    Merci,
    {{ config('app.name') }}
</x-mail::message>