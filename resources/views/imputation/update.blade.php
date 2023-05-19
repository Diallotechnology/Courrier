@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('imputation.update',$imputation) }}" type="update" url="{{ route('imputation') }}">
                <div class="col-md-12">
                    <x-select label="Courrier arrivé" name="courrier_id">
                        @foreach ($courrier as $row)
                        <option @selected($imputation->courrier_id == $row->id) value="{{ $row->id }}">Reférence {{
                            $row->reference }}, Numero d'arriver {{ $row->numero
                            }},Date
                            d'arriver {{
                            $row->date_format }}
                        </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-select label="Departement" name="departement_id">
                        @foreach ($departement as $row)
                        <option @selected($imputation->departement_id == $row->id) value="{{ $row->id }}"> {{ $row->nom
                            }}</option>
                        @endforeach
                    </x-select>
                </div>

                <div class="col-md-3">
                    <x-input type="date" label="Delai" :value="$imputation->delai" name='delai' :required='false' />
                </div>
                <div class="col-md-3">
                    <x-select name="priorite" label="Priorité">
                        <option @selected($imputation->Normal()) value="Normal">Normal</option>
                        <option @selected($imputation->Urgent()) value="Urgent">Urgent</option>
                    </x-select>
                </div>
                <h2 class="text-center py-3">Annotations et instructions</h2>
                <div class="divide-y">
                    <div class="mb-3">
                        <div class="row">
                            @forelse ($imputation->user->annotations as $row)

                            <div class="col-md-4">
                                <label class="form-check">
                                    <input class="form-check-input" @checked($imputation->annotations->contains('id',
                                    $row->id))
                                    value="{{ $row->id }}"
                                    name="annotation_id[]" type="checkbox">
                                    <span class="form-check-label">{{ $row->nom }}</span>
                                </label>

                            </div>
                            @empty
                            <label class="form-label text-center">Aucune annotation</label>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <x-textarea place="observation ou commentaire sur l'imputation" :value="$imputation->observation"
                        name="observation" :required='false' label="observation ou commentaire Facultatif" />
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection