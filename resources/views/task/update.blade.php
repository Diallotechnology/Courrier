@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-10 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('task.update',$task) }}" type="update" url="{{ route('task') }}">
                <div class="col-md-6">
                    <x-input type="text" :value="$task->nom" name="nom" place="le nom de la tache" />
                </div>
                <div class="col-md-6">
                    <x-select name="type" label="type de tache">
                        <option @selected(true) value="utilisateur">Utilisateur</option>
                    </x-select>
                </div>
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
                    label="description de la taches" />
            </x-form>
        </div>
    </div>
</div>
@endsection