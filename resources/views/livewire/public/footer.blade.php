<!-- Bloc Footer / Newsletter -->
<div class="bg-[rgb(72,6,28)] text-white p-8 sm:p-12 w-full shadow-lg">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
        
        <!-- Espace pour ajouter d'autres choses plus tard (Logo, Liens, Texte...) -->
        <div class="w-full md:w-1/2">
            <h3 class="text-2xl font-bold mb-2">Restez informé</h3>
            <p class="text-gray-200 text-sm">
                Inscrivez-vous à notre newsletter pour recevoir nos dernières actualités et mises à jour.
            </p>
            <!-- Tu pourras ajouter d'autres éléments ici -->
        </div>

        <!-- Zone d'abonnement -->
        <div class="w-full md:w-1/3 flex flex-col items-center md:items-end">
            <div class="w-full flex flex-col gap-3">
                
                <label class="text-sm font-semibold text-gray-200">S'abonner à la newsletter</label>
                
                <button 
                    wire:click="subNewsletterComponent()" 
                    class="w-full bg-white text-[rgb(72,6,28)] font-bold py-3 px-6 rounded-md shadow-md hover:bg-gray-100 hover:shadow-lg transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[rgb(72,6,28)] focus:ring-white"
                >
                    S'abonner
                </button>

                <!-- Message de succès affiché juste en dessous -->
                @if (session()->has('success'))
                    <div class="mt-2 p-3 bg-white/10 border border-green-400 text-green-300 rounded-md text-sm font-medium text-center backdrop-blur-sm">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>