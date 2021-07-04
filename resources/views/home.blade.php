<x-layout>
    @if($type=='categories')
        <div class="row">
            <div class="col-md-12">
                <livewire:amazon.search/>
            </div>
        </div>
       <div class="row mt-3">
           <div class="col-md-12">
               <livewire:amazon.categories/>
           </div>
       </div>
    @else
        <livewire:amazon.products category="{{$category}}"/>
    @endif
</x-layout>
