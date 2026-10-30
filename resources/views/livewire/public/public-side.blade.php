<x-app-layout>

    <!-- BANDEAU D'ANNONCE -->
    @php
        $announcement = showAnnouncement();
    @endphp

    @livewire('navigation-menu')
    <!-- CONTENU DE LA PAGE -->
    <!-- On crée une colonne flexible qui prend au minimum toute la hauteur de l'écran -->
    <div class="flex flex-col min-h-screen">
        
        <!-- Le contenu principal (flex-1 force ce bloc à prendre la place libre) -->
        <div class="flex-1">
            {{ $slot }}
        </div>

        <!-- FOOTER -->
        <livewire:public.Footer />
    </div>

</x-app-layout>