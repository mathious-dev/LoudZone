@props(['options','listSearch' => [],'search'=>'','searchWichColumn'=>'']) 

<div class="mb-8 w-full">
    <!-- Le grand conteneur fusionné avec une belle ombre -->
    <div class="flex shadow-md rounded-lg">
        
        <!-- Le Sélecteur -->
        <select wire:model.live="searchWichColumn" 
                class="block w-1/3 md:w-64 pl-4 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-l-lg bg-gray-50 text-gray-800 font-semibold cursor-pointer transition-colors hover:bg-gray-100">
            @foreach ($options as $possibility => $label)
                <option value="{{ $possibility }}">{{ $label }}</option>
            @endforeach
        </select>
        
        <!-- Le Champ de texte et les suggestions -->
        <div class="relative flex-grow focus-within:z-10">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <!-- Icône agrandie (h-6 w-6) -->
                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            
            <!-- L'input de recherche -->
            <input wire:model.live.debounce.300ms="search" 
                   type="text" 
                   placeholder="Rechercher..." 
                   class="block w-full pl-12 pr-4 py-3 text-base border-l-0 border-gray-300 rounded-none rounded-r-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400">
            
            <!-- ========================================== -->
            <!-- MENU FLOTTANT DES SUGGESTIONS              -->
            <!-- ========================================== -->
            @if(!empty($search) && count($listSearch) > 0)
            <div class="absolute z-50 left-0 right-0 mt-2 bg-white border border-gray-100 rounded-lg shadow-2xl overflow-hidden">
                <ul class="divide-y divide-gray-100 max-h-60 overflow-y-auto">
                    @foreach ($listSearch as $resultSearch)
                        <li>
                            <button wire:click='selectSearch({{ $resultSearch->id }})' 
                                    class="block w-full text-left px-4 py-3 text-base text-gray-700 hover:bg-gray-50 hover:text-[#5D0824] focus:bg-gray-50 focus:outline-none transition-colors duration-150">
                                {{ $resultSearch->$searchWichColumn }}
                            </button> 
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
        </div>
        
    </div>
</div>