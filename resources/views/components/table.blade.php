@props(['header', 'rows' => ''])
<div class="col-12">
    <div class="card">
        {{ $header }}
        <div wire:loading>
            <div class="text-center justify-content-center">
                <h1 class="text-center">Loading<span class="animated-dots"></span></h1>
            </div>
        </div>
        <div {{ $attributes->merge(['class' => 'table-responsive']) }}>
            <div wire:loading.remove>
                <table id="datatable" {{ $attributes->merge(['class' => 'table card-table table-vcenter text-nowrap
                    datatable']) }}>
                    {{ $slot }}
                    <h3 id="no-results" class="text-center " style="display:none;">Aucun resultat trouvé.</h3>

                </table>
            </div>
        </div>

        <div class="card-footer align-items-center">
            @if($rows)
            {{ $rows->links() }}
            @endif
        </div>
    </div>
</div>
