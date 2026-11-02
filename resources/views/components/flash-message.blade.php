<div x-data="{ 
        show: false, 
        message: '', 
        type: 'success',
        
        // Fonction pour afficher le toast dynamiquement
        fireToast(toastMessage, toastType) {
            this.message = toastMessage;
            this.type = toastType;
            this.show = true;
            setTimeout(() => this.show = false, 4000);
        }
     }" 
     
     {{-- 1. AU CHARGEMENT DE LA PAGE (Redirections) --}}
     x-init="
        @if(session()->has('flashMessage'))
            fireToast('{{ addslashes(session('flashMessage')['message']) }}', '{{ session('flashMessage')['type'] }}');
        @endif
     "
     
     {{-- 2. EN COURS DE ROUTE (Livewire Ajax : delete, etc.) --}}
     @toast.window="fireToast($event.detail.message, $event.detail.type)"
     
     x-show="show"
     x-transition:enter="transform ease-out duration-300 transition"
     x-transition:enter-start="-translate-y-full"
     x-transition:enter-end="translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="translate-y-0"
     x-transition:leave-end="-translate-y-full"
     
     {{-- 3. La couleur change dynamiquement selon la variable Alpine `type` --}}
     class="w-full z-50 shadow-md fixed top-0 left-0"
     :class="type === 'error' ? 'bg-red-600' : 'bg-green-600'"
     style="display: none;"> <!-- display: none de base pour éviter les clignotements -->
    
    <div class="max-w-7xl mx-auto px-4 py-2 sm:px-6 lg:px-8 flex items-center justify-between">
        
        <div class="flex items-center space-x-3 text-white">
            <div class="flex-shrink-0">
                
                {{-- Icône Succès --}}
                <svg x-show="type === 'success'" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                
                {{-- Icône Erreur --}}
                <svg x-show="type === 'error'" style="display: none;" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

            </div>
            
            {{-- Le texte Alpine dynamique --}}
            <p class="text-sm font-medium" x-text="message"></p>
        </div>
        
        <button @click="show = false" class="flex-shrink-0 text-white hover:text-gray-200 focus:outline-none transition-colors">
            <span class="sr-only">Fermer</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        
    </div>
</div>