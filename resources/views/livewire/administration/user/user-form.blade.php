<div class="max-w-2xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    
    <!-- Ton titre dynamique -->
    @if($isEditing)
        <h2 class="text-xl font-bold mb-6 text-gray-800">Modification de {{ $user->name }}</h2>
    @else
        <h2 class="text-xl font-bold mb-6 text-gray-800">Création d'un utilisateur</h2>
    @endif

    <!-- .prevent empêche le rechargement brutal de la page -->
    <form wire:submit.prevent="saveForm" class="space-y-6">
        
        <!-- Grille pour afficher Nom et Prénom sur la même ligne (sur grand écran) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" wire:model="first_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('first_name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('email') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
             @if ($isEditing)
             <div x-data="{open:false}">
            <button type="button" x-on:click="open=!open">Réinitialiser le mot de passe</button>
                <div x-show="open">
                    <input type="password" wire:model="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
             </div>
            
            @else
            <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input type="password" wire:model="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @endif
            @error('password') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Case à cocher -->
        <div class="flex items-center mt-4">
            <input type="checkbox" id="newsletter" wire:model="news_letter" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
            <label for="newsletter" class="ml-2 block text-sm text-gray-900 cursor-pointer">
                News Letter
            </label>
        </div>
        @error('news_letter') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

        <!-- Bouton de soumission (texte dynamique) -->
        <div class="flex justify-end pt-4 border-t border-gray-200 mt-6">
            <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                {{ $isEditing ? 'Mettre à jour' : 'Créer' }}
            </button>
        </div>
    
    </form>
</div>