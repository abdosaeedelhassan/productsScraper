<div wire:init="getCategories">

    <div class="row">
        <div class="col-md-12">
            <a wire:click="refreshCategories" class="btn btn-success">@lang('Refresh categories')</a>
        </div>
    </div>

    <div class="row">
        @if($categories)
            @foreach($categories as $category)
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <div class="card-header p-0">
                            <img style="height: 200px;width: 100%" src="{{$category['image']}}">
                        </div>
                        <div class="card-body">
                            {{$category['name']}}
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success" wire:click="openCategory('{{$category['url']}}')"
                               style="width: 100%">
                                Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @lang('No category added.')
        @endif
    </div>
    <x-loading target="getCategories"/>
    <x-loading target="refreshCategories"/>
</div>
