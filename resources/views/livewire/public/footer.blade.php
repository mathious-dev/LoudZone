<!-- Bloc Footer / Newsletter -->
<div class="bg-[rgb(72,6,28)] text-white p-8 sm:p-12 w-full shadow-lg mt-auto">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start gap-12">
        
        <!-- Colonne Gauche : Infos et Liens de navigation -->
        <div class="w-full md:w-1/2 flex flex-col gap-6">
            
            <!-- Texte d'intro -->
            <div>
                <h3 class="text-2xl font-bold mb-2">Restez informé</h3>
                <p class="text-white/80 text-sm leading-relaxed max-w-md">
                    Inscrivez-vous à notre newsletter pour recevoir nos dernières actualités et mises à jour directement dans votre boîte mail.
                </p>
            </div>
            
            <!-- Section Liens / Assistance -->
            <div class="pt-6 mt-2 border-t border-white/20 w-full max-w-md">
                <h4 class="text-lg font-semibold mb-4">Assistance</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('supportMessage.create') }}" 
                           class="inline-flex items-center gap-2 text-sm text-white/80 hover:text-white hover:translate-x-1 transition-all duration-300">
                            <!-- Petite icône sympa pour le support -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Faire une demande de support
                        </a>
                    </li>
                    <!-- Tu pourras ajouter d'autres liens ici (Contact, FAQ...) -->
                </ul>
            </div>

        </div>

        <!-- Colonne Droite : Zone d'abonnement -->
        <div class="w-full md:w-1/3 flex flex-col">
            <!-- Cadre légèrement transparent pour mettre la newsletter en valeur -->
            <div class="bg-white/10 p-6 rounded-xl border border-white/20 backdrop-blur-sm shadow-inner">
                
                <label class="block text-sm font-semibold text-white mb-4">S'abonner à la newsletter</label>
                
                <button 
                    wire:click="subNewsletterComponent()" 
                    class="w-full bg-white text-[rgb(72,6,28)] font-bold py-3 px-6 rounded-md shadow-md hover:bg-gray-100 hover:shadow-lg transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[rgb(72,6,28)] focus:ring-white flex justify-center items-center gap-2"
                >
                    <span>S'abonner</span>
                    <!-- Icône d'enveloppe -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </button>

                <!-- Message de succès affiché juste en dessous -->
                @if (session()->has('success'))
                    <div class="mt-4 p-3 bg-green-500/20 border border-green-400 text-green-100 rounded-md text-sm font-medium text-center">
                        {{ session('success') }}
                    </div>
                @endif
                
            </div>
        </div>

    </div>
</div>