<div class="max-w-3xl mx-auto mt-8 p-8 bg-white rounded-xl shadow-lg border border-gray-100">
    
    <!-- En-tête -->
    <div class="mb-8 border-b border-gray-100 pb-5">
        @if($isEditing)
            <h2 class="text-2xl font-extrabold text-gray-900">Modification de <span class="text-[#5D0824]">{{ $user->name }}</span></h2>
            <p class="text-sm text-gray-500 mt-1">Mettez à jour les informations et les accès de cet utilisateur.</p>
        @else
            <h2 class="text-2xl font-extrabold text-gray-900">Nouvel Utilisateur</h2>
            <p class="text-sm text-gray-500 mt-1">Créez un nouveau compte et définissez ses rôles.</p>
        @endif
    </div>

    <form wire:submit.prevent="saveForm" class="space-y-6">
        
        <!-- Identité (Nom / Prénom) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-5 rounded-lg border border-gray-100">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Nom <span class="text-red-500">*</span></label>
                <input type="text" wire:model="name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#5D0824] focus:ring-[#5D0824] sm:text-sm transition-colors">
                @error('name') <span class="text-xs text-red-500 mt-1 font-medium block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Prénom <span class="text-red-500">*</span></label>
                <input type="text" wire:model="first_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#5D0824] focus:ring-[#5D0824] sm:text-sm transition-colors">
                @error('first_name') <span class="text-xs text-red-500 mt-1 font-medium block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Email & Sécurité -->
        <div class="space-y-6 bg-gray-50 p-5 rounded-lg border border-gray-100">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Adresse Email <span class="text-red-500">*</span></label>
                <input type="email" wire:model="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#5D0824] focus:ring-[#5D0824] sm:text-sm transition-colors">
                @error('email') <span class="text-xs text-red-500 mt-1 font-medium block">{{ $message }}</span> @enderror
            </div>

            <!-- Gestion du Mot de passe -->
            <div>
                @if ($isEditing)
                    <div x-data="{ open: false }" class="border border-gray-200 rounded-md p-4 bg-white">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Sécurité du compte</span>
                            <button type="button" x-on:click="open = !open" 
                                    class="text-sm text-[#5D0824] hover:text-[#48041B] font-semibold flex items-center transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!open"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="open" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                <span x-text="open ? 'Annuler la modification' : 'Nouveau mot de passe'"></span>
                            </button>
                        </div>
                        
                        <div x-show="open" x-transition class="mt-4 pt-4 border-t border-gray-100" style="display: none;">
                            <label class="block text-xs text-gray-500 mb-1">Tapez un nouveau mot de passe pour écraser l'ancien :</label>
                            <input type="password" wire:model="password" placeholder="••••••••" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#5D0824] focus:ring-[#5D0824] sm:text-sm">
                        </div>
                    </div>
                @else
                    <label class="block text-sm font-bold text-gray-700 mb-1">Mot de passe provisoire <span class="text-red-500">*</span></label>
                    <input type="password" wire:model="password" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#5D0824] focus:ring-[#5D0824] sm:text-sm transition-colors">
                @endif
                @error('password') <span class="text-xs text-red-500 mt-1 font-medium block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Rôles (Format Grille Cliquable) -->
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-3">Rôles attribués</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                @foreach ($listRoles as $roleId => $roleName)
                    <label class="flex items-center space-x-3 p-3 bg-white border border-gray-200 rounded-md cursor-pointer hover:border-[#5D0824] hover:bg-gray-50 transition-all duration-200 group shadow-sm">
                        <input type="checkbox" wire:model='listRolesChoice' value="{{ $roleId }}"
                               class="w-4 h-4 text-[#5D0824] border-gray-300 rounded focus:ring-[#5D0824]">
                        <span class="text-sm font-medium text-gray-700 group-hover:text-[#5D0824] capitalize">
                            {{ $roleName }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Préférences (Newsletter) -->
        <div class="pt-2">
            <label class="flex items-center p-4 bg-blue-50 border border-blue-100 rounded-lg cursor-pointer hover:bg-blue-100 transition-colors">
                <input type="checkbox" wire:model="news_letter" class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <div class="ml-3">
                    <span class="block text-sm font-bold text-gray-900">Abonnement Newsletter</span>
                    <span class="block text-xs text-gray-500 mt-0.5">L'utilisateur accepte de recevoir les communications marketing.</span>
                </div>
            </label>
            @error('news_letter') <span class="text-xs text-red-500 mt-1 font-medium block">{{ $message }}</span> @enderror
        </div>

        <!-- Bouton Enregistrer -->
        <div class="flex justify-end pt-6 border-t border-gray-200">
            <a href="{{ route('admin.userList') }}" class="mr-4 px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5D0824] transition-colors">
                Annuler
            </a>
            <button type="submit" class="inline-flex items-center px-6 py-2 bg-[#5D0824] border border-transparent rounded-md shadow-sm text-sm font-bold text-white hover:bg-[#48041B] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5D0824] transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ $isEditing ? 'Mettre à jour l\'utilisateur' : 'Créer l\'utilisateur' }}
            </button>
        </div>
    
    </form>
</div>