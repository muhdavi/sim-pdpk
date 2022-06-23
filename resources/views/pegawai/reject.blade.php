<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tolak Usulan Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('usulan.verifikasi.store') }}">
                        @csrf
                        <input type="hidden" name="usulan_id" value="{{ $usulan->id }}"/>
                        <input type="hidden" name="pegawai" value="{{ $pegawai->id }}"/>

                        <div class="flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Nomor Agenda Usulan</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-80 whitespace-no-wrap font-bold text-black-800 mx-2">{{ $usulan->nomor_agenda }}</span>
                        </div>

                        <div class="flex mt-4">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Jenis Usulan</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-80 whitespace-no-wrap font-bold text-black-800 mx-2">
                                @if($usulan->jenis_kebutuhan == 1)
                                    {{ __('Perpanjangan') }}
                                @else
                                    {{ __('Penambahan Baru') }}
                                @endif
                            </span>
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Tanggal Mulai Kontrak</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 whitespace-no-wrap font-bold text-black-800 mx-2">{{ date('d-m-Y', strtotime($usulan->periode_awal)) }}</span>
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Tanggal Selesai Kontrak</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 whitespace-no-wrap font-bold text-black-800 mx-2">{{ date('d-m-Y', strtotime($usulan->periode_akhir)) }}</span>
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">NIK/Nomor Kontrak</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 whitespace-no-wrap font-bold text-black-800 mx-2">{{ $pegawai->nik }}</span>
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Nama</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 whitespace-no-wrap font-bold text-black-800 mx-2">{{ strtoupper($pegawai->nama) }}</span>
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Status</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 whitespace-no-wrap font-bold text-red-800 mx-2">{{ __('DITOLAK') }}</span>
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Keteranga</span>
                            <input class="flex border border-2 rounded-md px-4 py-2 bg-white whitespace-no-wrap font-bold text-black-800 mx-2 w-4/6" type="text" name="keterangan" id="keterangan" required autofocus />
                        </div>
                        <hr/>
                        <div class="flex items-center justify-end my-4 mx-4">
                            <x-button class="ml-3">
                                {{ __('SIMPAN') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
