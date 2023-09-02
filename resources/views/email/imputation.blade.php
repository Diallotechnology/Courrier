<x-mail::message>
    Bonjour
    <p>{{ $message }}</p>
    <x-mail::button :url="$url">Voir l'imputation</x-mail::button>
    Merci,
    {{ config('app.name') }}
</x-mail::message>