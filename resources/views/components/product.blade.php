<div class="col-md-6 mt-3">
    <div class="card">
        <div class="card-header p-0">
            <img style="height: 200px;width: 100%" src="{{$product['image']}}">
        </div>
        <div class="card-body">
            {{$product['description']}}
        </div>
        <div class="card-footer">
            @lang('Price') <span style="font-weight: bold">{{$product['price']}}</span>
            <span style="text-decoration: dashed">{{$product['old_price']}}</span>
        </div>
    </div>
</div>
