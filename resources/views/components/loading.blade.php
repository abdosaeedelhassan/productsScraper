@props(['target'=>''])
<div wire:loading wire:target="{{$target}}" align="center">
    <p style="text-align: center">@lang('Please wait...')</p>
</div>
