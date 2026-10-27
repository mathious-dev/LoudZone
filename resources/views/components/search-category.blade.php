@props(['options']) 

<div class="w-full">
    <select 
        wire:model.live="searchCategory" 
        class="block w-full border-gray-300 rounded-lg shadow-md focus:ring-indigo-500 focus:border-indigo-500 text-base text-gray-700 bg-white px-4 py-3 cursor-pointer transition-colors duration-200"
    >
        <option value="">Toutes les catégories</option>
        
        @foreach ($options as $possibility => $label)
            <option value="{{ $possibility }}">{{ $label }}</option>
        @endforeach
    </select>
</div>