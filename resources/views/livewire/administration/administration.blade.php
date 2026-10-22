<x-app-layout>
    @livewire('navigation-menu')
    <header class="bg-white shadow">
        <div class="w-full px-4 sm:px-6 lg:px-8 mx-auto py-6">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                Administration
            </h2>
        </div>
    </header>

    <div class="py-12">
        <!-- 1. Alpine.js contrôle l'état : locked (cadenas) et hovered (survol de la souris) -->
        <div x-data="{ locked: false, hovered: false }" class="w-full px-4 sm:px-6 lg:px-8 mx-auto flex gap-6">
            
            <!-- 2. Le Menu : Il écoute la souris et ajuste sa largeur -->
            <div 
                @mouseenter="hovered = true" 
                @mouseleave="hovered = false"
                :class="(locked || hovered) ? 'w-72' : 'w-20'"
                class="flex-shrink-0 transition-all duration-300 ease-in-out"
            >
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 sticky top-6">
                    
                    <!-- En-tête du menu + Bouton Cadenas -->
                    <div class="flex items-center justify-between mb-4 border-b pb-2">
                        <!-- Le titre s'affiche si le menu est ouvert -->
                        <h3 x-show="locked || hovered" class="font-bold text-gray-700 whitespace-nowrap">Menu Admin</h3>
                        
                        <!-- Si le menu est fermé, on met juste un petit trait pour faire joli -->
                        <div x-show="!locked && !hovered" class="w-full h-1 bg-gray-200 rounded"></div>
                        
                        <!-- Le bouton Cadenas -->
                        <button @click="locked = !locked" x-show="locked || hovered" class="text-gray-400 hover:text-indigo-600 focus:outline-none" title="Bloquer le menu">
                            <!-- Cadenas fermé (Locked) -->
                            <svg x-show="locked" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c26.5 0 48 21.5 48 48V464c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V240c0-26.5 21.5-48 48-48H80z"/></svg>
                            <!-- Cadenas ouvert (Unlocked) -->
                            <svg x-show="!locked" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 64c-44.2 0-80 35.8-80 80v48H384c26.5 0 48 21.5 48 48V464c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V240c0-26.5 21.5-48 48-48h16V144C80 64.5 144.5 0 224 0c57.5 0 107 33.7 130.1 82.3c7.6 16 .8 35.1-15.2 42.6s-35.1 .8-42.6-15.2C283.4 82.6 255.9 64 224 64z"/></svg>
                        </button>
                    </div>
                    
                    <!-- Liste des liens -->
                    <ul class="space-y-2 text-sm overflow-hidden">
                        
                        <!-- Exemple générique à copier pour chaque lien : 
                             On ajoute whitespace-nowrap sur le <a> et flex-shrink-0 sur l'icône -->
                        <li>
                            <a href="{{ route('admin.userList') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex justify-center">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M463 448.2C440.9 409.8 399.4 384 352 384L288 384C240.6 384 199.1 409.8 177 448.2C212.2 487.4 263.2 512 320 512C376.8 512 427.8 487.3 463 448.2zM64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320zM320 336C359.8 336 392 303.8 392 264C392 224.2 359.8 192 320 192C280.2 192 248 224.2 248 264C248 303.8 280.2 336 320 336z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Utilisateurs</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('admin.roleList') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex justify-center">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M256.1 72C322.4 72 376.1 125.7 376.1 192C376.1 258.3 322.4 312 256.1 312C189.8 312 136.1 258.3 136.1 192C136.1 125.7 189.8 72 256.1 72zM226.4 368L285.8 368C292.5 368 299 368.4 305.5 369.1C304.6 374 304.1 379 304.1 384.1L304.1 476.2C304.1 501.7 314.2 526.1 332.2 544.1L364.1 576L77.8 576C61.4 576 48.1 562.7 48.1 546.3C48.1 447.8 127.9 368 226.4 368zM352.1 476.2L352.1 384.1C352.1 366.4 366.4 352.1 384.1 352.1L476.2 352.1C488.9 352.1 501.1 357.2 510.1 366.2L606.1 462.2C624.8 480.9 624.8 511.3 606.1 530.1L530 606.2C511.3 624.9 480.9 624.9 462.1 606.2L366.1 510.2C357.1 501.2 352 489 352 476.3zM456.1 432C456.1 418.7 445.4 408 432.1 408C418.8 408 408.1 418.7 408.1 432C408.1 445.3 418.8 456 432.1 456C445.4 456 456.1 445.3 456.1 432z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Rôles</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.articleListAdmin') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex justify-center">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M256 144C256 108.7 284.7 80 320 80C355.3 80 384 108.7 384 144L384 192L256 192L256 144zM208 192L144 192C117.5 192 96 213.5 96 240L96 448C96 501 139 544 192 544L448 544C501 544 544 501 544 448L544 240C544 213.5 522.5 192 496 192L432 192L432 144C432 82.1 381.9 32 320 32C258.1 32 208 82.1 208 144L208 192zM232 240C245.3 240 256 250.7 256 264C256 277.3 245.3 288 232 288C218.7 288 208 277.3 208 264C208 250.7 218.7 240 232 240zM384 264C384 250.7 394.7 240 408 240C421.3 240 432 250.7 432 264C432 277.3 421.3 288 408 288C394.7 288 384 277.3 384 264z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Articles</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.historiesList') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex justify-center">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M64 128C64 110.3 78.3 96 96 96L544 96C561.7 96 576 110.3 576 128L576 160C576 177.7 561.7 192 544 192L96 192C78.3 192 64 177.7 64 160L64 128zM96 240L544 240L544 480C544 515.3 515.3 544 480 544L160 544C124.7 544 96 515.3 96 480L96 240zM248 304C234.7 304 224 314.7 224 328C224 341.3 234.7 352 248 352L392 352C405.3 352 416 341.3 416 328C416 314.7 405.3 304 392 304L248 304z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Historique</span>
                            </a>
                        </li>

                        <!-- ICÔNE DOUBLE (Message Support) -->
                        <li>
                            <a href="{{ route('admin.supportMessageList') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex items-center justify-center relative">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M64 416L64 192C64 139 107 96 160 96L480 96C533 96 576 139 576 192L576 416C576 469 533 512 480 512L360 512C354.8 512 349.8 513.7 345.6 516.8L230.4 603.2C226.2 606.3 221.2 608 216 608C202.7 608 192 597.3 192 584L192 512L160 512C107 512 64 469 64 416z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Messages support</span> 
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.supportMessageCategoryList') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <!-- On passe à w-8 et -ml-1 pour garder le texte aligné avec les autres -->
                                <div class="flex-shrink-0 w-8 flex items-center justify-center gap-0.5 -ml-1">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M64 416L64 192C64 139 107 96 160 96L480 96C533 96 576 139 576 192L576 416C576 469 533 512 480 512L360 512C354.8 512 349.8 513.7 345.6 516.8L230.4 603.2C226.2 606.3 221.2 608 216 608C202.7 608 192 597.3 192 584L192 512L160 512C107 512 64 469 64 416z"/></svg>
                                    <svg class="w-4 h-4 fill-current opacity-80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M192 112L304 112L304 200C304 239.8 336.2 272 376 272L464 272L464 512C464 520.8 456.8 528 448 528L192 528C183.2 528 176 520.8 176 512L176 128C176 119.2 183.2 112 192 112zM352 131.9L444.1 224L376 224C362.7 224 352 213.3 352 200L352 131.9zM192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 250.5C512 233.5 505.3 217.2 493.3 205.2L370.7 82.7C358.7 70.7 342.5 64 325.5 64L192 64z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Catégorie message support</span>
                            </a>
                        </li>

                        <!-- ICÔNE DOUBLE (Catégorie Article) -->
                        <li>
                            <a href="{{ route('admin.articleCategoryList') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-8 flex items-center justify-center gap-0.5 -ml-1">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M256 144C256 108.7 284.7 80 320 80C355.3 80 384 108.7 384 144L384 192L256 192L256 144zM208 192L144 192C117.5 192 96 213.5 96 240L96 448C96 501 139 544 192 544L448 544C501 544 544 501 544 448L544 240C544 213.5 522.5 192 496 192L432 192L432 144C432 82.1 381.9 32 320 32C258.1 32 208 82.1 208 144L208 192zM232 240C245.3 240 256 250.7 256 264C256 277.3 245.3 288 232 288C218.7 288 208 277.3 208 264C208 250.7 218.7 240 232 240zM384 264C384 250.7 394.7 240 408 240C421.3 240 432 250.7 432 264C432 277.3 421.3 288 408 288C394.7 288 384 277.3 384 264z"/></svg>
                                    <svg class="w-4 h-4 fill-current opacity-80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M192 112L304 112L304 200C304 239.8 336.2 272 376 272L464 272L464 512C464 520.8 456.8 528 448 528L192 528C183.2 528 176 520.8 176 512L176 128C176 119.2 183.2 112 192 112zM352 131.9L444.1 224L376 224C362.7 224 352 213.3 352 200L352 131.9zM192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 250.5C512 233.5 505.3 217.2 493.3 205.2L370.7 82.7C358.7 70.7 342.5 64 325.5 64L192 64z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Catégorie d'article</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.addInfoList') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex justify-center">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M104 112C90.7 112 80 122.7 80 136L80 184C80 197.3 90.7 208 104 208L152 208C165.3 208 176 197.3 176 184L176 136C176 122.7 165.3 112 152 112L104 112zM256 128C238.3 128 224 142.3 224 160C224 177.7 238.3 192 256 192L544 192C561.7 192 576 177.7 576 160C576 142.3 561.7 128 544 128L256 128zM256 288C238.3 288 224 302.3 224 320C224 337.7 238.3 352 256 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L256 288zM256 448C238.3 448 224 462.3 224 480C224 497.7 238.3 512 256 512L544 512C561.7 512 576 497.7 576 480C576 462.3 561.7 448 544 448L256 448zM80 296L80 344C80 357.3 90.7 368 104 368L152 368C165.3 368 176 357.3 176 344L176 296C176 282.7 165.3 272 152 272L104 272C90.7 272 80 282.7 80 296zM104 432C90.7 432 80 442.7 80 456L80 504C80 517.3 90.7 528 104 528L152 528C165.3 528 176 517.3 176 504L176 456C176 442.7 165.3 432 152 432L104 432z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Information supplémentaire</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.orderListAdmin') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex justify-center">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M0 72C0 58.7 10.7 48 24 48L69.3 48C96.4 48 119.6 67.4 124.4 94L124.8 96L312 96L312 198.1L281 167.1C271.6 157.7 256.4 157.7 247.1 167.1C237.8 176.5 237.7 191.7 247.1 201L319.1 273C328.5 282.4 343.7 282.4 353 273L425 201C434.4 191.6 434.4 176.4 425 167.1C415.6 157.8 400.4 157.7 391.1 167.1L360.1 198.1L360.1 96L537.5 96C557.5 96 572.6 114.2 568.9 133.9L537.8 299.8C532.1 330.1 505.7 352 474.9 352L171.3 352L176.4 380.3C178.5 391.7 188.4 400 200 400L456 400C469.3 400 480 410.7 480 424C480 437.3 469.3 448 456 448L200.1 448C165.3 448 135.5 423.1 129.3 388.9L77.2 102.6C76.5 98.8 73.2 96 69.3 96L24 96C10.7 96 0 85.3 0 72zM160 528C160 501.5 181.5 480 208 480C234.5 480 256 501.5 256 528C256 554.5 234.5 576 208 576C181.5 576 160 554.5 160 528zM384 528C384 501.5 405.5 480 432 480C458.5 480 480 501.5 480 528C480 554.5 458.5 576 432 576C405.5 576 384 554.5 384 528z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Commande</span>
                            </a>
                        </li>

                        <!-- ICÔNE DOUBLE (Commande Articles) -->
                        <li>
                            <a href="{{ route('admin.articleOrderListAdmin') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-8 flex items-center justify-center gap-0.5 -ml-1">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M0 72C0 58.7 10.7 48 24 48L69.3 48C96.4 48 119.6 67.4 124.4 94L124.8 96L312 96L312 198.1L281 167.1C271.6 157.7 256.4 157.7 247.1 167.1C237.8 176.5 237.7 191.7 247.1 201L319.1 273C328.5 282.4 343.7 282.4 353 273L425 201C434.4 191.6 434.4 176.4 425 167.1C415.6 157.8 400.4 157.7 391.1 167.1L360.1 198.1L360.1 96L537.5 96C557.5 96 572.6 114.2 568.9 133.9L537.8 299.8C532.1 330.1 505.7 352 474.9 352L171.3 352L176.4 380.3C178.5 391.7 188.4 400 200 400L456 400C469.3 400 480 410.7 480 424C480 437.3 469.3 448 456 448L200.1 448C165.3 448 135.5 423.1 129.3 388.9L77.2 102.6C76.5 98.8 73.2 96 69.3 96L24 96C10.7 96 0 85.3 0 72zM160 528C160 501.5 181.5 480 208 480C234.5 480 256 501.5 256 528C256 554.5 234.5 576 208 576C181.5 576 160 554.5 160 528zM384 528C384 501.5 405.5 480 432 480C458.5 480 480 501.5 480 528C480 554.5 458.5 576 432 576C405.5 576 384 554.5 384 528z"/></svg>
                                    <svg class="w-4 h-4 fill-current opacity-80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M256 144C256 108.7 284.7 80 320 80C355.3 80 384 108.7 384 144L384 192L256 192L256 144zM208 192L144 192C117.5 192 96 213.5 96 240L96 448C96 501 139 544 192 544L448 544C501 544 544 501 544 448L544 240C544 213.5 522.5 192 496 192L432 192L432 144C432 82.1 381.9 32 320 32C258.1 32 208 82.1 208 144L208 192zM232 240C245.3 240 256 250.7 256 264C256 277.3 245.3 288 232 288C218.7 288 208 277.3 208 264C208 250.7 218.7 240 232 240zM384 264C384 250.7 394.7 240 408 240C421.3 240 432 250.7 432 264C432 277.3 421.3 288 408 288C394.7 288 384 277.3 384 264z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Commande d'articles</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.paymentListAdmin') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex justify-center">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M128 96C92.7 96 64 124.7 64 160L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 256C576 220.7 547.3 192 512 192L136 192C122.7 192 112 181.3 112 168C112 154.7 122.7 144 136 144L520 144C533.3 144 544 133.3 544 120C544 106.7 533.3 96 520 96L128 96zM480 320C497.7 320 512 334.3 512 352C512 369.7 497.7 384 480 384C462.3 384 448 369.7 448 352C448 334.3 462.3 320 480 320z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Paiement</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.eventListAdmin') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex justify-center">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M224 64C206.3 64 192 78.3 192 96L192 128L160 128C124.7 128 96 156.7 96 192L96 240L544 240L544 192C544 156.7 515.3 128 480 128L448 128L448 96C448 78.3 433.7 64 416 64C398.3 64 384 78.3 384 96L384 128L256 128L256 96C256 78.3 241.7 64 224 64zM96 288L96 480C96 515.3 124.7 544 160 544L480 544C515.3 544 544 515.3 544 480L544 288L96 288z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>événement</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.promotionList') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex justify-center">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M96.5 160L96.5 309.5C96.5 326.5 103.2 342.8 115.2 354.8L307.2 546.8C332.2 571.8 372.7 571.8 397.7 546.8L547.2 397.3C572.2 372.3 572.2 331.8 547.2 306.8L355.2 114.8C343.2 102.7 327 96 310 96L160.5 96C125.2 96 96.5 124.7 96.5 160zM208.5 176C226.2 176 240.5 190.3 240.5 208C240.5 225.7 226.2 240 208.5 240C190.8 240 176.5 225.7 176.5 208C176.5 190.3 190.8 176 208.5 176z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Promotion</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.announcementList') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex justify-center">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M525.2 82.9C536.7 88 544 99.4 544 112L544 528C544 540.6 536.7 552 525.2 557.1C513.7 562.2 500.4 560.3 490.9 552L444.3 511.3C400.7 473.2 345.6 451 287.9 448.3L287.9 544C287.9 561.7 273.6 576 255.9 576L223.9 576C206.2 576 191.9 561.7 191.9 544L191.9 448C121.3 448 64 390.7 64 320C64 249.3 121.3 192 192 192L276.5 192C338.3 191.8 397.9 169.3 444.4 128.7L491 88C500.4 79.7 513.9 77.8 525.3 82.9zM288 384L288 384.2C358.3 386.9 425.8 412.7 480 457.6L480 182.3C425.8 227.2 358.3 253 288 255.7L288 384z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Annonce</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.cartListAdmin') }}" class="flex items-center gap-4 px-3 py-2 rounded-md text-gray-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition-colors whitespace-nowrap">
                                <div class="flex-shrink-0 w-6 flex justify-center">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M24 48C10.7 48 0 58.7 0 72C0 85.3 10.7 96 24 96L69.3 96C73.2 96 76.5 98.8 77.2 102.6L129.3 388.9C135.5 423.1 165.3 448 200.1 448L456 448C469.3 448 480 437.3 480 424C480 410.7 469.3 400 456 400L200.1 400C188.5 400 178.6 391.7 176.5 380.3L171.4 352L475 352C505.8 352 532.2 330.1 537.9 299.8L568.9 133.9C572.6 114.2 557.5 96 537.4 96L124.7 96L124.3 94C119.5 67.4 96.3 48 69.2 48L24 48zM208 576C234.5 576 256 554.5 256 528C256 501.5 234.5 480 208 480C181.5 480 160 501.5 160 528C160 554.5 181.5 576 208 576zM432 576C458.5 576 480 554.5 480 528C480 501.5 458.5 480 432 480C405.5 480 384 501.5 384 528C384 554.5 405.5 576 432 576z"/></svg>
                                </div>
                                <span x-show="locked || hovered" x-transition.opacity.duration.300ms>Panier</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 3. Contenu de la page -->
            <div class="flex-1 overflow-hidden">
                {{ $slot }}
            </div>

        </div>
    </div>
</x-app-layout>