<div wire:init="getProducts">
    <div class="row">
        <div class="col-md-12">
            <a wire:click="getProducts" class="btn btn-primary">@lang('Refresh products')</a>
            <x-loading target="getProducts"/>
        </div>
    </div>
    <div class="row mt-3">
            @if($products )
                @foreach($products as $product)
                    <x-product :product="$product"/>
                @endforeach
            @endif
    </div>
</div>
