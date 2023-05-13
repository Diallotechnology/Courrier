@extends('layouts.app')
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Corbeille des courriers interne</h3>
        </div>
        <div class="card-body">

            <x-filter trash="interne" :create="false" />
        </div>
    </x-slot>
    <thead>
        <tr>
            {{-- <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                    aria-label="Select all invoices"></th> --}}
            <th>ID</th>
            {{-- <th>Utilisateur</th> --}}
            <th>Reference</th>
            <th>Nature</th>
            <th>Expéditeur</th>
            <th>Destinateur</th>
            <th>Priorite</th>
            <th>Confidential</th>
            <th>Etat</th>
            <th>Delai de traitement</th>
            <th>Date d'envoi</th>
            <th>Date de suppression</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>

            {{-- <td><input class="form-check-input m-0 align-middle" id="{{ $row->id }}" wire:model="selectedRows"
                    value="{{ $row->id }}" type="checkbox" aria-label="Select item"></td> --}}
            <td>{{ $row->id }}</td>
            {{-- <td>
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2" style="background-image: url(./static/avatars/006m.jpg)"></span>
                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $row->user->name }}</div>
                        <div class="text-muted"><a href="#" class="text-reset">{{ $row->user->email }}</a></div>
                    </div>
                </div>
            </td> --}}
            <td>{{ $row->reference }}</td>
            <td>{{ $row->nature ? $row->nature->nom : 'inexistant' }}</td>

            <td>
                @if($row->expediteur)
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2"
                        style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->expediteur->name }}')"></span>
                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $row->expediteur->name }}</div>
                        <div class="text-muted">
                            <p class="text-reset">{{ $row->expediteur->email }}</p>
                        </div>
                    </div>
                </div>
                @else
                inexistant
                @endif
            </td>
            <td>
                @if($row->destinataire)
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2"
                        style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->destinataire->name }}')"></span>

                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $row->destinataire->name }}</div>
                        <div class="text-muted">
                            <p class="text-reset">{{ $row->destinataire->email }}</p>
                        </div>
                    </div>
                </div>
                @else
                inexistant
                @endif
            </td>


            <td>
                <x-statut type="prio" :courrier="$row" />
            </td>
            <td>
                <x-statut type="privacy" :courrier="$row" />
            </td>

            <td>
                <span @class(['status', 'status-success'=> $row->Send(), 'status-red' => $row->Recu()])>
                    <span class="status-dot status-dot-animated"></span>
                    {{ $row->etat }}
                </span>
            </td>
            <td>
                {{ $row->delai_format }}
            </td>
            {{-- <td>
                <p class="text-muted">{{ $row->objet }}</p>
            </td> --}}

            <td>{{ $row->created_at }}</td>
            <td>{{ $row->deleted_at }}</td>
            <td>

                <x-button-restore url="{{ url('interne/restore/'.$row->id) }}" />
                <x-button-delete url="{{ url('interne/delete/'.$row->id) }}" />
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