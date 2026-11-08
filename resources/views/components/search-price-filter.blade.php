@props(['listPriceFilters'])
<div>
    @if ($listPriceFilters)
        @foreach ($listPriceFilters as $priceFilter)
        <div>
            <label>{{$priceFilter->label}}</label>
            <input type="checkbox" wire:model.live='tabPriceFilterId' value="{{$priceFilter->id  }}">
        </div>
        @endforeach
    @endif
</div>
