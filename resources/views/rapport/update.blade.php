@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('rapport.update',$rapport) }}" type="update" url="{{ route('rapport') }}"
                enctype="multipart/form-data">

                <div class="col-md-6">
                    <x-input type="text" :value="$rapport->objet" name="objet" label="Objet du rapport" />
                </div>
                <div class="col-md-6">
                    <x-select name="type" label="Type de rapport">
                        @foreach ($type as $row)
                        <option @selected($rapport->type == $row) value="{{ $row }}">{{ $row }}
                        </option>
                        @endforeach
                    </x-select>
                </div>
                <p class="text-star">NB: Si ce rapport concerne un courrier arrivé veuillez le selectionnez</p>

                <div class="col-md-6">
                    <x-select name="courrier_id" label="Liste des courrier arrivé" :required='false'>
                        @foreach ($courrier as $row)
                        <option @selected($rapport->courrier_id == $row->id) value="{{ $row->id }}">Courrier arrivé N°{{
                            $row->reference }}
                        </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-input type="file" multiple name="files[]" label="Pièces jointe (PDF) facultatif"
                        :required='false' />

                </div>
                <label class="form-label">Votre rapport Facultatif</label>
                <textarea placeholder="contenu du rapport" id="tinymce-default"
                    name="contenu">{{ $rapport->contenu }}</textarea>
            </x-form>
        </div>
    </div>
</div>
@endsection