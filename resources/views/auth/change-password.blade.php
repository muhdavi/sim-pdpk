<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{--<a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
            </a>--}}
            <img src="{{ asset('assets/images/SIM-PDPK-BIRU.png') }}">
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Old Password -->
            <div>
                <x-label for="old_password" :value="__('Password Lama')"/>
                <x-input id="old_password" class="block mt-1 w-full"
                         type="password"
                         name="old_password"
                         required autocomplete="current-password"/>
            </div>

            <!-- New Password -->
            <div class="mt-4">
                <x-label for="new_password" :value="__('Password Baru')"/>
                <x-input id="new_password" class="block mt-1 w-full"
                         type="password"
                         name="new_password"
                         required autocomplete="current-password"/>
            </div>

            <!-- Retype New Password -->
            <div class="mt-4">
                <x-label for="retype_password" :value="__('Ketik Ulang Password Baru')"/>
                <x-input id="retype_password" class="block mt-1 w-full"
                         type="password"
                         name="retype_password"
                         required autocomplete="current-password"/>
            </div>

            <div class="flex justify-end mt-4">
                <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition"
                   href="{{ URL::previous() }}">
                    {{ __('BATAL') }}
                </a>
                <x-button class="ml-3">
                    {{ __('UBAH') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
