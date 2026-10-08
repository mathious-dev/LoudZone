<x-app-layout>
    <!-- On crée une colonne flexible qui prend au minimum toute la hauteur de l'écran -->
    <div class="flex flex-col min-h-screen">
        
        <!-- Le contenu principal (flex-1 force ce bloc à prendre toute la place libre, repoussant le footer vers le bas) -->
        <div class="flex-1">
            {{ $slot }}
        </div>


        <x-footer />
        
    </div>
</x-app-layout>