@props(['courrier'])
@if($courrier)
<div class="row row-cards">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Evolution du courrier</h2>
                <ul class="steps steps-green steps-counter my-4">
                    @foreach (App\Enum\CourrierEnum::cases() as $row)
                    <li @class(['step-item', 'active'=> $courrier->etat == $row ? true : false ])>{{ $row }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif