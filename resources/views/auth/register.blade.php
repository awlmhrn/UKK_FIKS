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
                    <div class="text-center mb-8 text-4xl text-[#004643] font-bold">Create Account</div>

                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div>
                            <x-label for="name" value="{{ __('Name') }}" class="text-[#004643]" />
                            <x-input id="name" class="block mt-1 w-full bg-white text-[#004643]" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" class="text-[#004643]" />
                            <x-input id="email" class="block mt-1 w-full bg-white text-[#004643]" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        </div>

                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}" class="text-[#004643]" />
                            <x-input id="password" class="block mt-1 w-full bg-white text-[#004643]" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-[#004643]" />
                            <x-input id="password_confirmation" class="block mt-1 w-full bg-white text-[#004643]" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4 text-[#004643]">
                                <label for="terms" class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />
                                    <span class="ms-2 text-sm">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-[#003832]">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-[#003832]">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </span>
                                </label>
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-6">
                            <a class="underline text-sm text-[#004643] hover:underline" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-button class="ms-4 inline-flex items-center px-4 py-2 bg-[#004643] border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#003832] focus:bg-[#003832] active:bg-[#004643] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#003832] transition ease-in-out duration-150">
                                {{ __('Register') }}
                            </x-button>
                        </div>
                    </form>
                </div>

                {{-- Optional Footer --}}
                <div class="text-sm text-center text-[#004643] mt-6">
                    <a href="{{ url('/') }}" class="hover:underline">← Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>