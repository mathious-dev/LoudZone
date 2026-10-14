@props(['options']) 

<div class="w-full max-w-xs">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Filtrer par catégorie
    </label>
    
    <select 
        wire:model.live="searchCategory" 
        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-700 bg-white px-3 py-2 cursor-pointer transition-colors duration-200"
    >
        <!-- L'option par défaut est beaucoup plus propre ainsi -->
        <option value="">Toutes les catégories</option>
        
        @foreach ($options as $possibility => $label)
            <option value="{{ $possibility }}">{{ $label }}</option>
        @endforeach
    </select>
</div>