<div>
    @forelse (Auth::user()->notifications as $row)
    <div class="list-group-item">
        <div class="row align-items-center">
            <div class="col-auto"><span class="status-dot d-block"></span></div>
            <div class="col text-truncate">
                <a href="#" class="text-body d-block text-uppercase"> {{ $row->data['type'] }}</a>
                <div class="d-block text-muted text-truncate mt-n1">
                    {{ $row->data['message'] }}
                </div>
            </div>
            <div class="col-auto">
                <a href="#" class="list-group-item-actions show">
                    <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @empty
    <h2 class="text-center mx-4"> Vous avez pas de notification</h2>
    @endforelse
</div>