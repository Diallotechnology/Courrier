@props(['row'])
@if($row)
<div class="card text-center mb-2 shadow">
    <div class="card-body file">
        <div class="file-action">
            <x-button-edit href="{{ route('document.edit', ['document' => $row]) }}" />
            <x-button-show href="{{ route('document.show', ['document' => $row]) }}" target="_blank" />
        </div>
        <div class="rounded my-4">
            <span style="
            font-size: 44PX;
            background-color: #f8f9fa;
            border-radius: 55px;
            padding: 12px;
        " class="ti ti-file text-blue"></span>
        </div>
        <div class="file-info">
            <span class="badge text-white badge-pill">PDF</span>
        </div>

    </div> <!-- .card-body -->
    <div class="card-footer bg-transparent border-0 fname">
        <strong>{{ $row->libelle }}</strong> <br>
        <strong>Date de creation {{ $row->created_at }}</strong>
    </div> <!-- .card-footer -->
</div> <!-- .card -->
@endif