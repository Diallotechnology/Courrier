@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('interne.update',$interne) }}" type="update" url="{{ route('interne') }}">

                <div class="col-md-6">
                    <x-select name="nature_id" label="Nature de courrier">
                        @foreach ($type as $row)
                        <option @selected($interne->nature_id == $row->id) value="{{ $row->id }}">{{ $row->nom }}
                        </option>
                        @endforeach
                    </x-select>
                </div>

                <div class="col-md-6">
                    <x-select name="destinataire_id" label="Destinataire (Correspondant)">
                        @foreach ($user as $key => $row)
                        <optgroup label="Departement {{ $key }}">
                            @foreach ($row as $item)
                            <option @selected($interne->destinataire_id == $item->id)
                                data-custom-properties="&lt;span class=&quot;avatar avatar-xs&quot;
                                style=&quot;background-image:
                                url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $item->name
                                }}')&quot;&gt;&lt;/span&gt;"
                                value="{{ $item->id }}">{{ $item->email }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </x-select>
                </div>

                <div class="col-md-6">
                    <x-select name="priorite" label="Priorité">
                        <option @selected($interne->Normal()) value="Normal">Normal</option>
                        <option @selected($interne->Urgent()) value="Urgent">Urgent</option>
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-select name="confidentiel" label="confidentiel">
                        <option @selected($interne->Privacy()) value="OUI">OUI</option>
                        <option @selected(!$interne->Privacy()) value="NON">NON</option>
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-input type="date" name="date" :value="$interne->delai" label="Delai de traitement facultatif"
                        :required='false' />
                </div>
                <div class="col-md-6">
                    <x-input type="file" multiple name="files[]" label="Pièces jointe (PDF) facultatif"
                        :required='false' />
                </div>
                <x-input place="objet du courrier" :value="$interne->objet" name="objet" label="Objet du courrier" />
                <label class="form-label">Votre message Facultatif</label>
                <textarea placeholder="contenu du courrier" id="tinymce-default"
                    name="contenu">{{ $interne->contenu }}</textarea>
            </x-form>
        </div>
    </div>
</div>
@endsection