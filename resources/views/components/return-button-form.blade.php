@props(['route'])

<div>
    <!-- On utilise bien $route sans les guillemets -->
    <a href="{{ route($route) }}" 
       title="Retour"
       class="group inline-flex items-center justify-center w-12 h-12 bg-white border border-[#84796F]/20 rounded-full shadow-sm text-[#41342D] hover:bg-[#5D0824] hover:text-[#FAF1E3] hover:border-[#5D0824] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5D0824]">
        
        <!-- L'icône de la flèche (épaisse et bien visible) -->
        <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform duration-200" 
             fill="none" 
             stroke="currentColor" 
             viewBox="0 0 24 24" 
             xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        
    </a>
</div>
