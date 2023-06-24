@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('depart.update',$depart) }}" type="update" url="{{ route('depart') }}">

                <div class="row">
                    <div class="col-md-6">
                        <x-select name="nature_id" label="Nature de courrier">
                            @foreach ($type as $row)
                            <option @selected($depart->nature_id == $row->id) value="{{ $row->id }}">{{ $row->nom }}
                            </option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="col-md-6">
                        <x-select name="correspondant_id[]" multiple label="Correspondant (Destinateurs)">
                            @foreach ($correspondant as $row)
                            <option @selected($depart->correspondants->contains('id',$row->id)) value="{{ $row->id
                                }}">{{
                                $row->nom }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="col-md-6">
                        <x-select name="priorite" label="Priorité">
                            <option @selected($depart->Normal()) value="Normal">Normal</option>
                            <option @selected($depart->Urgent()) value="Urgent">Urgent</option>
                        </x-select>
                    </div>
                    <div class="col-md-6">
                        <x-select name="confidentiel" label="confidentiel">
                            <option @selected($depart->Privacy()) value="OUI">OUI</option>
                            <option @selected(!$depart->Privacy()) value="NON">NON</option>
                        </x-select>
                    </div>
                    <div class="col-md-6">
                        <x-input type="date" name="date" :value="$depart->date" label="Date d'depart" />
                    </div>
                    <div class="col-md-6">
                        <x-input type="file" multiple name="files[]" label="Pièces jointe (PDF) facultatif"
                            :required='false' />
                    </div>
                    <div class="col-md-12">
                        <x-select name="courrier_id" :required='false'
                            label="Ce courrier depart est la reponse d'un courrier arriver? facultatif">
                            @foreach ($courrier as $row)
                            <option @selected($depart->courrier_id == $row->id) value="{{ $row->id }}">Reference {{
                                $row->reference }}, N° {{ $row->numero }}, Date
                                d'arriver {{
                                $row->date_format }}
                            </option>
                            @endforeach
                        </x-select>
                    </div>
                    <x-textarea :value="$depart->objet" place="objet du courrier" name="objet"
                        label="Objet/Origine du courrier" />
                    <x-textarea :value="$depart->observation" place="observation ou commentaire sur le courrier"
                        name="observation" :required='false' label="observation ou commentaire Facultatif" />
                </div>
            </x-form>
        </div>
    </div>
</div>

@endsection