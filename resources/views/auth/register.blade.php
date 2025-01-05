<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-lg font-semibold text-gray-700" />
            <x-text-input id="name"
                class="block mt-2 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Email Address -->
        <div class="mt-6">
            <x-input-label for="email" :value="__('Email')" class="text-lg font-semibold text-gray-700" />
            <x-text-input id="email"
                class="block mt-2 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <x-input-label for="password" :value="__('Password')" class="text-lg font-semibold text-gray-700" />
            <x-text-input id="password"
                class="block mt-2 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-lg font-semibold text-gray-700" />
            <x-text-input id="password_confirmation"
                class="block mt-2 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Address -->
        <div class="mt-6">
            <x-input-label for="address" :value="__('Address')" class="text-lg font-semibold text-gray-700" />
            <x-text-input id="address"
                class="block mt-2 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="text" name="address" :value="old('address')" required />
            <x-input-error :messages="$errors->get('address')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- City -->
        <div class="mt-6">
            <x-input-label for="city" :value="__('City')" class="text-lg font-semibold text-gray-700" />
            <x-text-input id="city"
                class="block mt-2 w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="text" name="city" :value="old('city')" required />
            <x-input-error :messages="$errors->get('city')" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-indigo-600 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button
                class="px-6 py-2 mt-2 bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-white font-semibold rounded-md">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
