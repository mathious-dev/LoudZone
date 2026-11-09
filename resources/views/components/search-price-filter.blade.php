<div class="w-full">
    <h3 class="text-sm font-bold text-[#41342D] mb-3">Filtrer par prix</h3>

    <div class="flex flex-col sm:flex-row gap-6">

        <!-- Options rapides (Les tranches depuis la BDD) -->
        @if ($listPriceFilters && count($listPriceFilters) > 0)
            <div class="flex flex-wrap gap-2">
                @foreach ($listPriceFilters as $priceFilter)
                    <label class="cursor-pointer">
                        <input type="checkbox"
                               wire:model.live="tabPriceFilterId"
                               value="{{ $priceFilter->id }}"
                               class="peer sr-only">

                        <div class="px-4 py-2 text-sm font-medium rounded-full border transition-all duration-200 bg-white text-gray-700 border-[#84796F]/30 hover:bg-[#FAF1E3] peer-checked:bg-[#5D0824] peer-checked:text-[#FAF1E3] peer-checked:border-[#5D0824] peer-checked:shadow-sm">
                            {{ $priceFilter->label }}
                        </div>
                    </label>
                @endforeach
            </div>
        @endif

        {{-- <!-- Option experte (Saisie manuelle) -->
        <div class="flex items-center gap-2 pl-0 sm:pl-4 sm:border-l border-[#84796F]/20">
            <div class="relative w-24">
                <input type="number" wire:model.live.debounce.500ms="customMinPrice" placeholder="Min"
                       class="w-full rounded-md border-[#84796F]/30 py-1.5 pl-3 pr-6 text-sm text-[#0B0A0B] focus:border-[#5D0824] focus:ring focus:ring-[#5D0824]/20 shadow-sm transition-colors">
                <span class="absolute inset-y-0 right-2 flex items-center text-gray-500 text-xs font-bold pointer-events-none">€</span>
            </div>

            <span class="text-[#84796F] font-bold">-</span>

            <div class="relative w-24">
                <input type="number" wire:model.live.debounce.500ms="customMaxPrice" placeholder="Max"
                       class="w-full rounded-md border-[#84796F]/30 py-1.5 pl-3 pr-6 text-sm text-[#0B0A0B] focus:border-[#5D0824] focus:ring focus:ring-[#5D0824]/20 shadow-sm transition-colors">
                <span class="absolute inset-y-0 right-2 flex items-center text-gray-500 text-xs font-bold pointer-events-none">€</span>
            </div>
        </div> --}}

    </div>
</div>
