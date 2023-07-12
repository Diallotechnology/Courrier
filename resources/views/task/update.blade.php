@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('task.update',$task) }}" type="update" url="{{ route('task') }}">
                <div class="col-md-6">
                    <x-input type="text" :value="$task->nom" name="nom" place="le nom de la tache" />
                </div>
                <div class="col-md-6">
                    <x-select name="type" label="type de tache">
                        <option @selected(Auth::user()->isStandard()) value="utilisateur">Utilisateur</option>
                        @if(!Auth::user()->isStandard())
                        <option @selected($task->type == "imputation") value="imputation">Imputation</option>
                        @endif
                    </x-select>
                </div>
                @if(!Auth::user()->isStandard())
                <h3 class="my-2">Si la tache concerne une imputation</h3>
                <div class="col-md-12">
                    <div wire:ignore>
                        <x-select name="imputation_id" :required="false" label="liste des imputations facultatif">
                            @foreach ($imp as $item)
                            <option value="{{ $item->id }}">imputation N°{{ $item->numero }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                @endif
                <div class="col-md-12">
                    <x-select name="user_id[]" multiple label="liste des Utilisateurs">
                        @foreach ($user as $key => $row)
                        <optgroup label="Departement {{ $key }}">
                            @foreach ($row as $item)
                            <option @selected($task->users->contains('id', $item->id))
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
                    <x-input type="datetime-local" :value="$task->debut" name="debut" label="Debut de la tache" />
                </div>
                <div class="col-md-6">
                    <x-input type="datetime-local" :value="$task->fin" name="fin" label="Fin de la tache" />
                </div>
                <x-textarea place="Fait une description de la tache" :value="$task->description" name="description"
                    label="description de la tache" />
            </x-form>
        </div>
    </div>
</div>
@endsection