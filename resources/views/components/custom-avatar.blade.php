@props(['row'])
@if($row)
<div class="d-flex py-1 align-items-center">
    <span class="avatar me-2" @if ($row->sexe === "Homme")
        style="background-image: url('/img/h.svg');"
        @elseif ($row->sexe === "Femme")
        style="background-image: url('/img/f.svg');"
        @endif
        >
    </span>

    <div class="flex-fill">
        <div class="font-weight-medium">{{ $row->name }}</div>
        <div class="text-muted">
            <p class="text-reset">{{ $row->email }}</p>
        </div>
    </div>
</div>
@else
inexistant
@endif