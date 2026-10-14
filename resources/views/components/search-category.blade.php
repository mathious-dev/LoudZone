@props(['options']) 
<div>
    <select wire:model.live="searchCategory">
        <option value="">-</optionvalue>
        @foreach ($options as $possibility=>$label)
            <option value="{{$possibility}}">{{ $label }}</option>
        @endforeach
    </select>
</div>
