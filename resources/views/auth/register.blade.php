<x-guest-layout>
    <!-- Conteneur principal -->
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gray-900 py-16">

        <!-- L'ARRIÈRE-PLAN VIDÉO -->
        <video autoplay loop muted playsinline class="absolute z-0 w-auto min-w-full min-h-full max-w-none object-cover opacity-60">
            <!-- <source src="{{ asset('videos/ton-fond.mp4') }}" type="video/mp4" /> -->
        </video>

        <!-- Filtre bordeaux -->
        <div class="absolute z-0 inset-0 bg-[#48041B]/40 mix-blend-multiply"></div>

        <!-- LA CARTE DU FORMULAIRE -->
        <!-- pt-16 crée l'espace à l'intérieur pour le logo, mt-16 crée l'espace à l'extérieur -->
        <div class="relative z-10 w-full sm:max-w-md px-8 pb-10 pt-16 mt-16 bg-white/95 backdrop-blur-sm shadow-2xl sm:rounded-3xl border-t-4 border-[#48041B]">
            
            <!-- ========================================== -->
            <!-- LE LOGO BRUT : Mi-dedans, mi-dehors        -->
            <!-- ========================================== -->
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <!-- Agrandissement simple x1.5 sans AUCUN fond ni cercle -->
                <div class="scale-[3] origin-center">
                    <x-authentication-card-logo />
                </div>
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nom -->
                <div>
                    <x-label for="name" value="{{ __('Name') }}" class="text-[#48041B] font-bold" />
                    <x-input id="name" class="block mt-1 w-full border-gray-300 focus:border-[#48041B] focus:ring-[#48041B] rounded-md shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <!-- Prénom -->
                <div class="mt-4">
                    <x-label for="first_name" value="{{ __('First_Name') }}" class="text-[#48041B] font-bold" />
                    <x-input id="first_name" class="block mt-1 w-full border-gray-300 focus:border-[#48041B] focus:ring-[#48041B] rounded-md shadow-sm" type="text" name="first_name" :value="old('first_name')" required autocomplete="given-name" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" class="text-[#48041B] font-bold" />
                    <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-[#48041B] focus:ring-[#48041B] rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <!-- Mot de passe -->
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-[#48041B] font-bold" />
                    <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#48041B] focus:ring-[#48041B] rounded-md shadow-sm" type="password" name="password" required autocomplete="new-password" />
                </div>
                
                <!-- Confirmation Mot de passe -->
                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-[#48041B] font-bold" />
                    <x-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-[#48041B] focus:ring-[#48041B] rounded-md shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <!-- Newsletter -->
                <div class="mt-5 flex items-center bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <x-input id="news_letter" class="rounded border-gray-300 text-[#48041B] shadow-sm focus:ring-[#48041B] w-5 h-5" type="checkbox" name="news_letter" />
                    <x-label for="news_letter" value="{{ __('News letter') }}" class="ml-3 text-gray-700 font-medium cursor-pointer" />
                </div>
                
                <!-- CGV -->
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-start">
                                <x-checkbox name="terms" id="terms" required class="mt-1 text-[#48041B] focus:ring-[#48041B]" />

                                <div class="ms-3">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="font-semibold underline text-sm text-[#48041B] hover:text-[#300211] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#48041B]">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="font-semibold underline text-sm text-[#48041B] hover:text-[#300211] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#48041B]">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <!-- Boutons -->
                <div class="flex flex-col-reverse sm:flex-row items-center justify-between mt-8 gap-4">
                    <a class="text-sm font-medium text-gray-500 hover:text-[#48041B] underline transition-colors" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3 bg-[#48041B] border border-transparent rounded-lg font-bold text-sm text-white tracking-widest hover:bg-[#300211] focus:bg-[#300211] active:bg-[#1a0109] focus:outline-none focus:ring-2 focus:ring-[#48041B] focus:ring-offset-2 transition-all duration-200 shadow-[0_4px_14px_0_rgba(72,4,27,0.39)] hover:shadow-[0_6px_20px_rgba(72,4,27,0.23)] hover:-translate-y-0.5">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>