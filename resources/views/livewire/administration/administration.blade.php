<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Administration
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- 1. Remplacement de max-w-7xl par w-full (ou max-w-[95%]) -->
        <div class="w-full px-4 sm:px-6 lg:px-8 mx-auto flex gap-6">
            
            <!-- 2. Menu : on lui donne une taille FIXE (w-64 = 256px) -->
            <div class="w-64 flex-shrink-0">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 sticky top-6">
                    <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">Menu Admin</h3>
                    
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="{{ route('admin.userList') }}" class="block px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                Utilisateurs
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.roleList') }}" class="block px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                Rôles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.articleListAdmin') }}" class="block px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                Articles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.historiesList') }}" class="block px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                Historique
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.supportMessageList') }}" class="block px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                Messages support
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.articleCategoryList') }}" class="block px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                Catégorie d'article
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.addInfoList') }}" class="block px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                Information supplémentaire
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 3. Contenu : flex-1 lui dit "Prends absolument TOUT l'espace restant" -->
            <div class="flex-1 overflow-hidden">
                {{ $slot }}
            </div>

        </div>
    </div>
</x-app-layout>