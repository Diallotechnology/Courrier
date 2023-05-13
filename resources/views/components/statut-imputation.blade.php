@props(['row'])
@if($row)
<span @class(['status', 'status-green'=> $row->Complet(),
    'status-red'=> $row->Pending(),
    'status-indigo' => $row->Progress(),
    ])>
    <span class="status-dot status-dot-animated"></span>
    {{ $row->etat }}
</span>
@endif