<div>
    <div class="row">
        <div class="col-md-12">
            <a wire:click="refreshProducts" class="btn btn-primary">@lang('Refresh products')</a>
            <x-loading target="refreshProducts"/>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3 p-0">
            <x-loading target="getProducts"/>
            @if($categories)
                <ul class="list-unstyled">
                    @foreach($categories as $category)
                        <li wire:click="setCategory('{{$category->id}}')"

                            style="border: 1px solid gray;cursor: pointer;background-color: {{$category['id']==$selected_category->id?'gray':'white'}}"
                        >
                            <table>
                                <tr>
                                    <td><img style="width: 50px;height: 50px" src="{{$category->image}}"></td>
                                    <td>{{$category->name}}</td>
                                </tr>
                            </table>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="col-md-9">
            <div class="row">
                <x-loading target="setCategory"/>
                @if($products )
                    @foreach($products as $product)
                            <x-product :product="$product"/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <a class="btn btn-success mt-3" style="width: 100%" href="/">Go back</a>
</div>
