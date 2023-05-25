@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-10 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('document.update',$document) }}" type="update" url="{{ route('document') }}"
                enctype="multipart/form-data">
                <div class="col-md-6">
                    <x-input type="text" :value="$document->libelle" name="libelle" place="libelle du document" />
                </div>
                <div class="col-md-6">
                    <x-input type="file" name="file" label='Piece jointes ou fichiers PDF' :required="false" />
                </div>
                <div class="col-md-6">
                    <x-select label="Type de courrier">
                        <option selected value="{{ $document->type }}">{{ $document->type
                            }}</option>
                    </x-select>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection