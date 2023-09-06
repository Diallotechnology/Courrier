@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card p-3">
            <h2 class="mb-3 text-center">Formulaire de nouveau rapport</h2>

            <x-form route="{{ route('rapport.store') }}" enctype="multipart/form-data">
                <div class="col-md-5">
                    <x-input type="text" name="objet" label="Objet du rapport" />
                </div>
                <div class="col-md-4">
                    <x-select name="type" label="Type de rapport">
                        @foreach ($type as $row)
                        <option @selected(old('typr')==$row) value="{{ $row }}">{{ $row }}
                        </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-md-3">
                    <x-input type="file" multiple name="files[]" label="Pièces jointe (PDF) facultatif"
                        :required='false' />
                </div>
                <p class="text-star">Remarque: Si ce rapport concerne un courrier arrivé veuillez le selectionnez</p>

                <div class="col-md-6">
                    <x-select name="courrier_id" label="Liste des courrier arrivé" :required='false'>
                        @foreach ($courrier as $row)
                        <option @selected(old('courrier_id')==$row->id) value="{{ $row->id }}">Courrier arrivé N°{{
                            $row->reference }}
                        </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-select name="personne_id[]" multiple :required='false'
                        label="Personne à qui le rapport est accessible Facultatif">
                        @foreach ($user as $key => $row)
                        <optgroup label="Departement {{ $key }}">
                            @foreach ($row as $item)
                            <option data-custom-properties="&lt;span
                                class=&quot;avatar avatar-xs&quot; style=&quot;background-image:
                                url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $item->name
                                }}')&quot;&gt;&lt;/span&gt;" value="{{ $item->id }}">{{ $item->email }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </x-select>
                </div>
                <label class="form-label">Votre rapport Facultatif</label>
                <textarea placeholder="contenu du rapport" id="tinymce-default" name="contenu"></textarea>
            </x-form>
        </div>
    </div>
</div>

@endsection