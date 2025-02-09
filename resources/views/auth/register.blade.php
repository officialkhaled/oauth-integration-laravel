<x-guest-layout>

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

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
