<div wire:ignore>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
               aria-selected="true">
                Search Now
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
               aria-selected="false">
                Auto search
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card">
                <div class="card-body">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 5%">
                                @lang('Search')
                            </td>
                            <td>
                                <input type="text" wire:model.lazy="search"
                                       class="form-control"
                                       width="100%"
                                       placeholder="Type her"
                                >
                            </td>
                            <td style="width: 5%">
                                <a class="btn btn-sm btn-success" wire:click="doSearch">@lang('Search')</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <x-loading target="doSearch"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                @error('search') <span style="color: red">{{ $message }}</span> @enderror
                            </td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-2">
                            @lang('Search keywords')
                        </label>
                        <div class="col-md-10">
                            <input type="text" wire:model.lazy="search_keywords" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <label class="col-md-2">
                            @lang('Search every')
                        </label>
                        <div class="col-md-5">
                            <select wire:model.lazy="search_hours" class="form-control">
                                @for($i=0;$i<=12;$i++)
                                    <option value="{{$i}}">{{$i}} @if($i==1)Hour @else Hours @endif</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-5">
                            <select wire:model.lazy="search_minutes" class="form-control">
                                @for($i=0;$i<=60;$i++)
                                    <option value="{{$i}}">{{$i}} @if($i==1)Minute @else Minutes @endif</option>
                                @endfor
                            </select>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-sm btn-success" wire:click="saveSettings">@lang('Save')</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
