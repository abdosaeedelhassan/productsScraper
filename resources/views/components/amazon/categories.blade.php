<div>
    <div class="row">
        @foreach($categories as $key=>$category)
            <div class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-header p-0">
                        <img style="height: 200px;width: 100%" src="{{$category['image']}}">
                    </div>
                    <div class="card-body">
                        {{$category['name']}}
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-success" href="/products{{$category['url']}}" style="width: 100%">
                            Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-loading target="getCategories"/>
</div>
