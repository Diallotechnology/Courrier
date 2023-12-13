<div>
    @section('header')
    <div class="col">
        <div class="mb-1">
            <ol class="breadcrumb" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Courrier interne</a></li>
            </ol>
        </div>
        <h2 class="page-title">
            <span class="text-truncate">Liste des courriers interne</span>
        </h2>
    </div>
    @endsection
    @section('content')
    <x-table :rows="$rows" url="interne" :create="false">
        <x-slot name="filter">
            <div class="col-sm-4 col-md-3">
                <div wire:ignore>
                    <x-select label="Nature de courrier" wire:model.live='nature'>
                        @foreach ($type as $row)
                        <option value="{{ $row->id }}">{{ $row->nom }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="col-sm-4 col-md-3">
                <div wire:ignore>
                    <x-select label="Priorite" wire:model.live='priority'>
                        <option value="Urgent">Urgent</option>
                        <option value="Normal">Normal</option>
                    </x-select>
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <div wire:ignore>
                    <x-select label="Confidentialité" wire:model.live='privacy'>
                        <option value="OUI">OUI</option>
                        <option value="NON">NON</option>
                    </x-select>
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <div wire:ignore>
                    <x-select label="Etat" wire:model.live='etat'>
                        @foreach (App\Enum\CourrierInterneEnum::cases() as $row)
                        <option value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <x-input type="date" label="Date d'envoi" wire:model.live='date' />
            </div>
            <x-slot name="btn">
                @can('create',App\Models\Interne::class)
                <a href="{{ route('interne.create') }}" class="btn btn-primary mx-2" role="button">
                    <i class="ti ti-plus"></i>
                    Nouveau
                </a>
                @endcan
            </x-slot>

        </x-slot>
        <thead>
            <tr>
                <th>ID</th>
                <th>Reference</th>
                <th>Nature</th>
                <th>Expéditeur</th>
                <th>Destinateur</th>
                <th>Priorite</th>
                <th>Confidential</th>
                <th>Etat</th>
                <th>Delai de traitement</th>
                <th>Date d'envoi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
            <tr wire:key="{{ $row->id }}">
                <td>{{ $row->id }}</td>
                <td>{{ $row->numero }}</td>
                <td>{{ $row->nature_view() }}</td>
                <td>
                    <x-custom-avatar :row="$row->expediteur" />
                </td>
                <td>
                    <x-custom-avatar :row="$row->destinataire" />
                </td>
                <td>
                    <x-statut type="prio" :courrier="$row" />
                </td>
                <td>
                    <x-statut type="privacy" :courrier="$row" />
                </td>

                <td>
                    <span @class(['status', 'status-success'=> $row->Send(), 'status-red' => $row->Recu(),
                        'status-indigo'
                        => $row->Read()])>
                        <span class="status-dot status-dot-animated"></span>
                        {{ $row->etat }}
                    </span>
                </td>
                <td>
                    {{ $row->delai_format }}
                </td>
                <td>{{ $row->created_at }}</td>
                <td>
                    @can('create',$row)
                    @if($row->Recu() || $row->Read())
                    <a aria-label="Button" href="{{ route('interne.show', ['interne' => $row]) }}"
                        class="btn btn-primary btn-icon">
                        <i class="ti ti-mail-forward"></i>
                    </a>
                    @endif
                    @endcan
                    @if ($row->folder)
                    <x-button-folder href="{{ route('folder.show', ['folder' => $row->folder]) }}" />
                    @endif
                    <x-button-edit :row="$row" href="{{ route('interne.edit', ['interne' => $row]) }}" />
                    <x-button-show :row="$row" href="{{ route('interne.show', ['interne' => $row]) }}" />
                    <x-button-delete :row="$row" url="{{ url('courrier/interne/'.$row->id) }}" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11">
                    <h2 class="text-center">Aucun element</h2>
                </td>
            </tr>
            @endforelse
        </tbody>
    </x-table>
    @endsection

</div>