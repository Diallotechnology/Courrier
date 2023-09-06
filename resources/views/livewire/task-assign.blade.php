<div>
    <div class="card">
        <h2 class="m-3">Assignation de tache</h2>
        <div class="row m-3">
            <div class="col">
                <div wire:ignore>
                    <x-select wire:model="user_id" multiple label="liste des Utilisateurs exécuteur">
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
            </div>
            <div class="col-auto">
                <button type="button" wire:click="valid" class="btn mt-4 btn-indigo">
                    <i class="ti ti-checks"></i> Assigné
                </button>
            </div>
        </div>
    </div>
</div>