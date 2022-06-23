<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Perangkat Daerah') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-72">Nama Perangkat Daerah</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $satuan_kerja->satuan_kerja }} ({{ $satuan_kerja->nama_singkat }})</span>
                    </div>

                    <div class="flex mt-4">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-72">Jabatan Kepala Perangkat Daerah</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $satuan_kerja->nama_jabatan }}</span>
                    </div>

                    <div class="mt-4 flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-72">Nama Kepala Perangkat Daerah</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $satuan_kerja->nama_kepala }}</span>
                    </div>

                    <div class="mt-4 flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-72">Kouta Formasi PDPK</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $satuan_kerja->kouta }}</span>
                    </div>

                    <div class="mt-4 flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-72">Jumlah Bulan yang Dibayar</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $satuan_kerja->jumlah_bulan }}</span>
                    </div>
                </div>

                <hr/>
                <div class="flex items-center justify-end my-4 mx-4">
                    <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                       href="{{ URL::previous() }}">
                        {{ __('KEMBALI') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
