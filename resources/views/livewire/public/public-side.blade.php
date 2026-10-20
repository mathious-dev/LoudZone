<x-app-layout>

    <!-- BANDEAU D'ANNONCE -->
    @php
        $announcement = showAnnouncement();
    @endphp

    @if ($announcement)
        <div class="bg-[#48041B] text-white px-4 py-2.5 text-center text-sm font-medium shadow-sm w-full">
            <span class="font-bold uppercase tracking-wider mr-2">{{ $announcement->label }}</span>
            <span class="opacity-90">{{ $announcement->content }}</span>
        </div>
    @endif
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