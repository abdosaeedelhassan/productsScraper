<div wire:init="getProducts">

    <div class="row">
        <div class="col-md-3 p-0">
            <x-loading target="getProducts"/>
            <ul class="list-unstyled">
                @foreach($categories as $key=>$category)
                    <li  wire:click="setCategory('{{$category['url']}}')"

                         style="border: 1px solid gray;cursor: pointer;background-color: {{$category['url']==$selected_category?'gray':'white'}}"
                    >
                        <table>
                            <tr>
                                <td><img style="width: 50px;height: 50px" src="{{$category['image']}}"></td>
                                <td>{{$category['name']}}</td>
                            </tr>
                        </table>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-9">
            <div class="row">
                <x-loading target="setCategory"/>
            @foreach($products as $key=>$product)
                    @if(strlen($product['image'])>0)
                        <div class="col-md-6 mt-3">
                            <div class="card">
                                <div class="card-header p-0">
                                    <img style="height: 200px;width: 100%" src="{{$product['image']}}">
                                </div>
                                <div class="card-body">
                                    {{$product['description']}}
                                </div>
                                <div class="card-footer">
                                    @lang('Price') <span style="font-weight: bold">{{$product['price']}}$</span>
                                    <span style="text-decoration: dashed">{{$product['old_price']}}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <a class="btn btn-success mt-3" style="width: 100%" href="/">Go back</a>
</div>
