@props(['options']) 

<div class="mb-8 w-full">
    <!-- Le grand conteneur fusionné avec une belle ombre -->
    <div class="flex shadow-md rounded-lg">
        
        <!-- Le Sélecteur (Plus large: w-64, texte plus grand: text-base, padding augmenté: py-3) -->
        <select wire:model.live="searchWichColumn" 
                class="block w-1/3 md:w-64 pl-4 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-l-lg bg-gray-50 text-gray-800 font-semibold cursor-pointer transition-colors hover:bg-gray-100">
            @foreach ($options as $possibility => $label)
                <option value="{{ $possibility }}">{{ $label }}</option>
            @endforeach
        </select>
        
        <!-- Le Champ de texte (Plus grand, icône plus grosse) -->
        <div class="relative flex-grow focus-within:z-10">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <!-- Icône agrandie (h-6 w-6 au lieu de h-5) -->
                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            
            <!-- Padding vertical (py-3) et texte de base (text-base au lieu de sm:text-sm) -->
            <input wire:model.live.debounce.300ms="search" 
                   type="text" 
                   placeholder="Rechercher..." 
                   class="block w-full pl-12 pr-4 py-3 text-base border-l-0 border-gray-300 rounded-none rounded-r-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400">
        </div>
        
    </div>
</div>