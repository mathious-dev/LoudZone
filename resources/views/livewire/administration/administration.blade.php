<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Administration
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-6">
            
            <!-- Menu Admin (Gauche) -->
            <div class="w-1/4">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">Menu Admin</h3>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="{{ route('admin.userCrud') }}" class="text-indigo-600 font-semibold hover:underline">
                                Utilisateurs
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contenu Livewire (Droite) -->
            <div class="w-3/4">
                {{ $slot }}
            </div>

        </div>
    </div>
</x-app-layout>