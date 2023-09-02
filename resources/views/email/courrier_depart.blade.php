<x-mail::message>
    Bonjour
    <h3>La structure {{ $depart->structure->nom }} vous a addressé un nouveau courrier depart.</h3>
    <h3>Detail du courrier</h3>
    <p>
        Courrier départ N°{{ $depart->numero }}
        @if ($depart->courrier)
        en réponse du courrier arrivé N°{{ $depart->courrier->reference }}
        @endif
    </p>
    <p>Departement initiateur: {{ $depart->initiateur->userable->nom }}</p>
    <p>Nature: {{ $depart->nature->nom }}</p>
    <p>Priorité: {{ $depart->priorite }}</p>
    <p>Objet: {{ $depart->objet }}</p>
    <p>Observation: {{ $depart->observation }}</p>
    <p>Date de depart: {{ $depart->date_format }}</p>
    <p>Date de creation: {{ $depart->created_at }}</p>
    Merci,
    {{ config('app.name') }}
</x-mail::message>