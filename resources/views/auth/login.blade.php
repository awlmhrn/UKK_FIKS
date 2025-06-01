<x-guest-layout>
    <div class="relative w-full h-screen">
        {{-- Background --}}
        <div class="absolute inset-0 bg-[#004643]"></div>

        {{-- Foreground: translucent layer --}}
        <div class="relative z-10 min-h-screen bg-[#004643]/60 flex items-center justify-center px-4">
            {{-- Card --}}
            <div class="w-full md:w-[50vw] h-[calc(100vh-2rem)] bg-[#F0EDE5] shadow-md rounded-xl px-7 md:px-32 py-6 flex flex-col justify-between">
                
                {{-- Logo --}}
                <div class="text-center mb-2">
                    <a href="{{ url('/') }}">
                    <div class="font-extrabold text-2xl text-[#004643] drop-shadow-md">
                        SIJA'26
                    </div>
                    </a>
                </div>

                {{-- Form --}}
                <div>
                    <div class="text-center mb-8 text-4xl text-[#004643] font-bold">Welcome Back!</div>

                    <x-validation-errors class="mb-4" />

                    @session('status')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ $value }}
                        </div>
                    @endsession

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <x-label for="email" value="{{ __('Email') }}" class="text-[#004643]" />
                            <x-input id="email" class="block mt-1 w-full bg-white text-[#004643]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        </div>

                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}" class="text-[#004643]" />
                            <x-input id="password" class="block mt-1 w-full bg-white text-[#004643]" type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <div class="block mt-4 flex items-center justify-between">
                            <label for="remember_me" class="flex items-center text-[#004643]">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-[#004643] hover:underline" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-button class="w-full justify-center inline-flex items-center px-4 py-2 bg-[#004643] border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#003832] focus:bg-[#003832] active:bg-[#004643] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#003832] transition ease-in-out duration-150">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </div>

                {{-- Footer --}}
                <div class="text-sm text-center text-[#004643] mt-6">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-[#004643] font-bold hover:underline">Register</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>