<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login-drive') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Visionner vos photos avec votre code ci dessous : ')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="drive" :value="old('email')" required autofocus />
            <x-input-error :messages="session()->get('error')" class="mt-2" />

        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="https://equicode.fr/#contact">
                    {{ __('Vous rencontrez une difficulté ?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Acceder au drive') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
