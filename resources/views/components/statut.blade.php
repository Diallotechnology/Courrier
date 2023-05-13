@props(['courrier', 'type' => ''])
@if(isset($type) and !empty($type))
@if($type === "privacy")
<span @class(['status','status-red'=> $courrier->Privacy(),'status-indigo' => !$courrier->Privacy()])>

    {{ $courrier->confidentiel }}
</span>
@endif
@if($type === "prio")
<span @class(['status','status-red'=> $courrier->Urgent(),'status-indigo' => $courrier->Normal()])>
    {{ $courrier->priorite }}
</span>
@endif
@if($type === "etat")
<span @class(['status', 'status-green'=> $courrier->Complet(),
    'status-red'=> $courrier->Impute(),
    'status-info'=> $courrier->Register(),
    'status-indigo' => $courrier->Progress(),
    'status-secondary' => $courrier->Archive(),
    ])>
    <span class="status-dot status-dot-animated"></span>
    {{ $courrier->etat }}
</span>
@endif
@endif