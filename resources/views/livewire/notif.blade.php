<div>
    <div class="card-header">
        <div class="col">
            <h3 class="card-title">{{ count(Auth::user()->unreadNotifications) }} Notifications

            </h3>
        </div>
        <div class="col-auto">
            <button wire:click='delete' class="btn btn-danger btn-sm btn-icon">
                <i class="ti ti-x"></i>
            </button>
            <button wire:click='valid' class="btn btn-success btn-sm btn-icon">
                <i class="ti ti-check"></i>
            </button>
        </div>
    </div>
    <div class="list-group list-group-flush list-group-hoverable">
        @forelse ($notif as $row)
        <div class="list-group-item">
            <div class="row align-items-center">
                <div class="col-auto"><span class="status-dot d-block"></span></div>
                <div class="col ">
                    <a href="#" class="text-body d-block text-uppercase"> {{ $row->type }}</a>
                    <div class="d-block text-muted text-truncate mt-n1">
                        {{-- {{ $row->data }} --}}
                        Sapiente fugit ducimus qui et similique voluptas.
                    </div>
                </div>
            </div>
        </div>
        @empty
        <h2 class="text-center mx-4"> Vous avez pas de notification</h2>
        @endforelse
    </div>
</div>