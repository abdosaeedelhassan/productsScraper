<div class="col-md-6 mt-3">
    <div class="card">
        <div class="card-header p-0">
            <img style="height: 200px;width: 100%" src="{{$product['image']}}">
        </div>
        <div class="card-body">



            <table>
                <tr>
                    <td>
                        {{$product['description']}}
                    </td>
                </tr>
                <tr>
                    <td>
                        @lang('Price') <span style="font-weight: bold">{{$product['price']}}</span>
                        <span style="text-decoration: dashed">{{$product['old_price']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{$product['url']}}" target="_blank">Open product in the store</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Created at: {{$product['created_at']}}
                    </td>
                </tr>
            </table>


        </div>
    </div>
</div>
