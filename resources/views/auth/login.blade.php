<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <div class="mt-1 mb-3 flex justify-evenly gap-12">
        <a href="{{route('login.google')}}" data-toggle="tooltip" data-placement="top" title="Google Sign In!"
           class="py-2 btn btn-sm text-white w-14 shadow-md hover:shadow-lg">
            <img src="{{ asset('assets/google.png') }}" alt="google">
        </a>
        <a href="{{route('login.facebook')}}" data-toggle="tooltip" data-placement="top" title="Facebook Sign In!"
           class="py-2 btn btn-sm text-white w-14 shadow-md hover:shadow-lg">
            <img src="{{ asset('assets/facebook.png') }}" alt="facebook">
        </a>
        <a href="{{route('login.github')}}" data-toggle="tooltip" data-placement="top" title="GitHub Sign In!"
           class="py-2 btn btn-sm text-white w-14 shadow-md hover:shadow-lg">
            <img src="{{ asset('assets/github.png') }}" alt="github">
        </a>
    </div>

    <span class="text-sm text-gray-500 mb-2 flex justify-center">Or login using your email</span>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <div class="mt-4 flex justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            <div class="">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('register') }}">
                {{ __('Not a member yet? Sign up now') }}
            </a>

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
