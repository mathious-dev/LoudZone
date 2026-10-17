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
        <div class="relative z-10 w-full sm:max-w-md px-8 pb-10 pt-16 mt-16 bg-white/95 backdrop-blur-sm shadow-2xl sm:rounded-3xl border-t-4 border-[#48041B]">
            
            <!-- ========================================== -->
            <!-- LE LOGO BRUT : Mi-dedans, mi-dehors        -->
            <!-- ========================================== -->
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <!-- Agrandissement avec la syntaxe à crochets (ici doublé) -->
                <div class="scale-[2] origin-center">
                    <x-authentication-card-logo />
                </div>
            </div>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-label for="email" value="{{ __('Email') }}" class="text-[#48041B] font-bold" />
                    <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-[#48041B] focus:ring-[#48041B] rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <!-- Mot de passe -->
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-[#48041B] font-bold" />
                    <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#48041B] focus:ring-[#48041B] rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password" />
                </div>

                <!-- Se souvenir de moi -->
                <div class="mt-5 flex items-center bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <x-input id="remember_me" class="rounded border-gray-300 text-[#48041B] shadow-sm focus:ring-[#48041B] w-5 h-5" type="checkbox" name="remember" />
                    <x-label for="remember_me" value="{{ __('Remember me') }}" class="ml-3 text-gray-700 font-medium cursor-pointer" />
                </div>

                <!-- Boutons -->
                <div class="flex flex-col-reverse sm:flex-row items-center justify-between mt-8 gap-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-gray-500 hover:text-[#48041B] underline transition-colors" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3 bg-[#48041B] border border-transparent rounded-lg font-bold text-sm text-white tracking-widest hover:bg-[#300211] focus:bg-[#300211] active:bg-[#1a0109] focus:outline-none focus:ring-2 focus:ring-[#48041B] focus:ring-offset-2 transition-all duration-200 shadow-[0_4px_14px_0_rgba(72,4,27,0.39)] hover:shadow-[0_6px_20px_rgba(72,4,27,0.23)] hover:-translate-y-0.5">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>

            <!-- Lien vers l'inscription -->
            <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-600">
                    Pas encore de compte ? 
                    <a href="{{ route('register') }}" class="font-bold text-[#48041B] hover:text-[#300211] hover:underline transition-colors">
                        S'inscrire
                    </a>
                </p>
            </div>

        </div>
    </div>
</x-guest-layout>