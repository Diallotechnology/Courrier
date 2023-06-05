@extends('layouts.app')
@section('content')

<div class="card">
    <div class="row g-4">
        <div class="col-3">

            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action active">Boite</a>
                <a href="#" class="list-group-item list-group-item-action">envoyé</a>
            </div>
        </div>
        <div class="col-9">
            <div class="row row-cards">
                <div class="list-group list-group-flush overflow-auto py-3" style="max-height: 36rem">
                    <div class="list-group-header sticky-top"></div>
                    @foreach ($rows as $row)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto"><input type="checkbox" class="form-check-input"></div>
                            <div class="col text-truncate">
                                <a href="#" class="text-reset d-block">
                                    <div class="d-block mt-n1">{{ $row['subject'] }}</div>
                                    <div class="d-block mt-n1">il ya</div>
                                </a>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</div>
@endsection