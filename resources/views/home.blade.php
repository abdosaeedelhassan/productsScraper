<x-layout>
    <div class="row">
        <div class="col-md-12">
            <livewire:amazon.search/>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            @if($type=='categories')
                <livewire:amazon.categories/>
            @else
                <livewire:amazon.products category="{{$category}}"/>
            @endif
        </div>
    </div>

</x-layout>
