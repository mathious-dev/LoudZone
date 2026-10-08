@props(['options']) 

<div class="flex shadow-md rounded-lg bg-white border border-gray-200">
    
    <!-- Sélecteur de colonne pour le tri -->
    <select wire:model.live="searchAscDescWichColumn" 
            class="block w-32 md:w-40 pl-4 pr-8 py-3 text-sm border-0 border-r border-gray-200 focus:ring-0 rounded-l-lg bg-gray-50 text-gray-700 font-medium cursor-pointer hover:bg-gray-100 transition-colors">
        @foreach ($options as $possibility => $label)
            <option value="{{ $possibility }}">Trier par: {{ $label }}</option> 
        @endforeach
    </select>
    
    <!-- Sélecteur de l'ordre (A-Z / Z-A) -->
    <select wire:model.live="searchAscDesc" 
            class="block w-24 pl-4 pr-8 py-3 text-sm border-0 focus:ring-0 rounded-r-lg bg-white text-indigo-600 font-bold cursor-pointer hover:bg-gray-50 transition-colors text-center">
        <option value="">- Ordre -</option>
        <option value="asc">Croissant (A-Z)</option>
        <option value="desc">Décroissant (Z-A)</option>
    </select>
    
</div>