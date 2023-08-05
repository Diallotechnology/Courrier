@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card p-3">
            <h2 class="mb-3 text-center">Formulaire de nouveau courrier interne</h2>
            <x-form route="{{ route('interne.store') }}" enctype="multipart/form-data">
                <div class="col-md-6">
                    <x-select name="nature_id" label="Nature du courrier">
                        @foreach ($type as $row)
                        <option value="{{ $row->id }}">{{ $row->nom }}
                        </option>
                        @endforeach
                    </x-select>
                </div>

                <div class="col-md-6">
                    <x-select name="destinataire_id" label="Destinataire">
                        @foreach ($user as $key => $row)
                        <optgroup label="Departement {{ $key }}">
                            @foreach ($row as $item)
                            <option
                                data-custom-properties="&lt;span class=&quot;avatar avatar-xs&quot;  style=&quot;background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $item->name }}')&quot;&gt;&lt;/span&gt;"
                                value="{{ $item->id }}">{{ $item->email }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </x-select>
                </div>

                <div class="col-md-6">
                    <x-select name="priorite" label="Priorité">
                        <option value="Normal">Normal</option>
                        <option value="Urgent">Urgent</option>
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-select name="confidentiel" label="confidentiel">
                        <option value="OUI">OUI</option>
                        <option value="NON">NON</option>
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-input type="date" name="date" label="Delai de traitement facultatif" :required='false' />
                </div>
                <div class="col-md-6">
                    <x-input type="file" multiple name="files[]" label="Pièces jointe (PDF,DOC,IMAGE) facultatif"
                        :required='false' />
                </div>
                <x-input place="objet du courrier" name="objet" label="Objet du courrier" />
                <label class="form-label">Votre message Facultatif</label>
                <textarea placeholder="contenu du courrier" id="tinymce-default" name="contenu"></textarea>
            </x-form>
        </div>
    </div>
</div>

@endsection
