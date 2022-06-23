<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{--<a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
            </a>--}}
            <img src="{{ asset('assets/images/SIM-PDPK-BIRU.png') }}">
        </x-slot>
        <p class="text-center font-bold">Maaf, Anda masuk ke halaman 404! <br/>
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('home') }}">
                        {{ __('Kembali ke HOME') }}
                    </a>
                    </p>
    </x-auth-card>
</x-guest-layout>