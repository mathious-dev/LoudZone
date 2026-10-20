@props(['labelTrue', 'labelFalse']) 

<div class="relative shadow-sm rounded-lg bg-white border border-gray-200 overflow-hidden">
    
    <select wire:model.live="searchBoolean" 
            class="block w-full pl-4 pr-10 py-2.5 text-sm font-bold border-0 focus:ring-0 bg-transparent text-indigo-600 cursor-pointer hover:bg-gray-50 transition-colors">
        <option value="">-</option>
        <option value="1">{{ $labelTrue }}</option>
        <option value="0">{{ $labelFalse }}</option>
    </select>
    
</div>