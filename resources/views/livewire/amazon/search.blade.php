<div>
    <div class="card">
        <div class="card-body">
            <table style="width: 100%">
                <tr>
                    <td style="width: 5%">
                        @lang('Search')
                    </td>
                    <td>
                        <input type="text" wire:model.lazy="search"
                               class="form-control"
                               width="100%"
                               placeholder="Type her"
                        >
                    </td>
                    <td style="width: 5%">
                        <a class="btn btn-sm btn-success" wire:click="doSearch">@lang('Search')</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <x-loading target="doSearch"/>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @if($result)
        <div class="row">
            @foreach($result as $key=>$product)
                <x-product :product="$product"/>
            @endforeach
        </div>
    @endif
</div>
