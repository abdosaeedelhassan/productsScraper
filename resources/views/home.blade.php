<x-layout>
    @if($type=='categories')
        <livewire:amazon.categories/>
    @else
        <livewire:amazon.products category="{{$category}}"/>
    @endif
</x-layout>
