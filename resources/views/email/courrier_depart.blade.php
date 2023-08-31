<x-mail::message>
    Bonjour
    <h4>La structure {{ $depart->structure->nom }} vous a addressé un nouveau courrier depart.</h4>
    <h4>Detail du courrier</h4>
    <h6>
        Courrier départ N°{{ $depart->numero }}
        @if ($depart->courrier)
        en réponse du courrier arrivé N°{{ $depart->courrier->reference }}
        @endif
    </h6>
    <h6>Departement initiateur: {{ $depart->initiateur->userable->nom }}</h6>
    <h6>Nature: {{ $depart->nature->nom }}</h6>
    <h6>Priorité: {{ $depart->priorite }}</h6>
    <h6>Objet: {{ $depart->objet }}</h6>
    <h6>Observation: {{ $depart->observation }}</h6>
    <h6>Date d'envoi: {{ $depart->date_format }}</h6>
    <h6>Date de creation: {{ $depart->created_at }}</h6>
    Merci,<br>
    {{ config('app.name') }}
</x-mail::message>