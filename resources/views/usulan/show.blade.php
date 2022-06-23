<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lihat Usulan Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Periode</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $usulans->periode->periode }}</span>
                    </div>

                    <div class="mt-4 flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Tanggal Mulai Kontrak</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ date('d-m-Y', strtotime($usulans->periode->periode_awal)) }}</span>
                    </div>

                    <div class="mt-4 flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Tanggal Selesai Kontrak</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ date('d-m-Y', strtotime($usulans->periode->periode_akhir)) }}</span>
                    </div>

                    <div class="flex mt-4">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Nomor Pertimbangan Teknis</span>
                        @if($usulans->nomor_pertek)
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-green-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $usulans->nomor_pertek }}</span>
                        @else
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap text-black-800 mx-2"><i>{{ __('--Nomor PERTEK belum tersedia--') }}</i></span>
                        @endif
                    </div>

                    <div class="flex mt-4">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Tanggal Pertimbangan Teknis</span>
                        @if($usulans->tanggal_pertek)
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-green-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ date('d-m-Y', strtotime($usulans->tanggal_pertek)) }}</span>
                        @else
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap text-black-800 mx-2"><i>{{ __('--Tanggal PERTEK belum tersedia--') }}</i></span>
                        @endif
                    </div>

                    <div class="flex mt-4">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Nomor Agenda Usulan</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $usulans->nomor_agenda }}</span>
                    </div>

                    <div class="flex mt-4">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Jenis Usulan</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                            @if($usulans->jenis_kebutuhan == 1)
                                {{ __('Perpanjangan') }}
                            @else
                                {{ __('Pengusulan Baru') }}
                            @endif
                        </span>
                    </div>

                    <div class="mt-4 flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Tanggal</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ date('d-m-Y', strtotime($usulans->tanggal)) }}</span>
                    </div>

                    <div class="mt-4 flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Perihal</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ ucwords($usulans->perihal) }}</span>
                    </div>
                </div>

                <table class="table-fixed w-full">
                    <thead class="bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-white w-16 ">No</th>
                        <th class="px-4 py-2 text-white">NIK</th>
                        <th class="px-4 py-2 text-white">Nama</th>
                        <th class="px-4 py-2 text-white">Pendidikan</th>
                        <th class="px-4 py-2 text-white">Alasan Penolakan</th>
                        <th class="px-4 py-2 text-white w-96">Status Usulan</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @php($no=0)
                    @forelse($usulans->pegawai as $usulan_pegawai)
                        <tr>
                            <td class="text-center">{{ $no = $no + 1 }}</td>
                            <td class="text-center">{{ $usulan_pegawai->nik }}</td>
                            <td>{{ strtoupper($usulan_pegawai->nama) }}</td>
                            <td class="text-center">{{ $usulan_pegawai->pendidikan->pendidikan }}</td>
                            <td class="text-center">
                                @if($usulan_pegawai->pivot->keterangan_gampong)
                                <p class="font-bold text-xs italic text-red-500">{{ $usulan_pegawai->pivot->keterangan_gampong }}</p>
                                @elseif($usulan_pegawai->pivot->keterangan_bkpsdm)
                                <p class="font-bold text-xs italic text-red-500">{{ $usulan_pegawai->pivot->keterangan_bkpsdm }}</p>
                                @elseif($usulan_pegawai->pivot->keterangan_pemda)
                                <p class="font-bold text-xs italic text-red-500">{{ $usulan_pegawai->pivot->keterangan_pemda }}</p>
                                @else
                                <p class="font-bold text-xs italic text-gray-500">{{ __('-') }}</p>
                                @endif
                                </td>
                            <td class="text-center px-2 py-2">
{{--                                https://tailwindcomponents.com/component/steps-bar--}}
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="w-1/4">
                                            <div class="relative mb-2">
                                                @if(is_null($usulan_pegawai->pivot->status_gampong))
                                                    <div class="flex w-10 h-10 mx-auto bg-white rounded-full text-lg text-white items-center border-2 border-gray-200 ">
                                                        <span class="text-center text-gray-600 w-full">
                                                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-label="DPMG">
                                                                <title>DPMG</title>
                                                                <path class="heroicon-ui" d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm14 8V5H5v6h14zm0 2H5v6h14v-6zM8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 8a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                @elseif($usulan_pegawai->pivot->status_gampong == 1)
                                                    <div class="flex w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white items-center">
                                                        <span class="text-center text-white w-full">
                                                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-label="DPMG">
                                                                <title>DPMG</title>
                                                                <path class="heroicon-ui" d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm14 8V5H5v6h14zm0 2H5v6h14v-6zM8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 8a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="flex w-10 h-10 mx-auto bg-red-500 rounded-full text-lg text-white items-center">
                                                        <span class="text-center text-white w-full">
                                                            <a href="{{ url('/') }}">
                                                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-label="DPMG">
                                                                <title>DPMG</title>
                                                                <path class="heroicon-ui" d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm14 8V5H5v6h14zm0 2H5v6h14v-6zM8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 8a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                            </svg>
                                                            </a>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="w-1/4">
                                            <div class="relative mb-2">
                                                <div class="absolute flex align-center items-center align-middle content-center"
                                                     style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                                                    <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                                        @if($usulan_pegawai->pivot->status_gampong == 1)
                                                            <div class="w-0 bg-green-300 py-1 rounded" style="width: 100%;"></div>
                                                        @else
                                                            <div class="w-0 bg-green-300 py-1 rounded" style="width: 0%;"></div>
                                                        @endif
                                                    </div>
                                                </div>

                                                @if(is_null($usulan_pegawai->pivot->status_bkpsdm))
                                                    <div class="flex w-10 h-10 mx-auto bg-white rounded-full text-lg text-white items-center border-2 border-gray-200 ">
                                                        <span class="text-center text-gray-600 w-full">
                                                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-label="BKPSDM">
                                                                <title>BKPSDM</title>
                                                                <path class="heroicon-ui" d="M19 10h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2h-2a1 1 0 0 1 0-2h2V8a1 1 0 0 1 2 0v2zM9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                @elseif($usulan_pegawai->pivot->status_bkpsdm == 1)
                                                    <div class="flex w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white items-center">
                                                        <span class="text-center text-white w-full">
                                                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-label="BKPSDM">
                                                                <title>BKPSDM</title>
                                                                <path class="heroicon-ui" d="M19 10h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2h-2a1 1 0 0 1 0-2h2V8a1 1 0 0 1 2 0v2zM9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="flex w-10 h-10 mx-auto bg-red-500 rounded-full text-lg text-white items-center">
                                                        <span class="text-center text-white w-full">
                                                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-label="BKPSDM">
                                                                <title>BKPSDM</title>
                                                                <path class="heroicon-ui" d="M19 10h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2h-2a1 1 0 0 1 0-2h2V8a1 1 0 0 1 2 0v2zM9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="w-1/4">
                                            <div class="relative mb-2">
                                                <div class="absolute flex align-center items-center align-middle content-center"
                                                     style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                                                    <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                                        @if($usulan_pegawai->pivot->status_bkpsdm == 1)
                                                            <div class="w-0 bg-green-300 py-1 rounded" style="width: 100%;"></div>
                                                        @else
                                                            <div class="w-0 bg-green-300 py-1 rounded" style="width: 0%;"></div>
                                                        @endif
                                                    </div>
                                                </div>

                                                @if(is_null($usulan_pegawai->pivot->status_pemda))
                                                    <div class="flex w-10 h-10 mx-auto bg-white rounded-full text-lg text-white items-center border-2 border-gray-200 ">
                                                        <span class="text-center text-gray-600 w-full">
                                                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-label="SEKDAKAB">
                                                                <title>SEKDAKAB</title>
                                                                <path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                @elseif($usulan_pegawai->pivot->status_pemda == 1)
                                                    <div class="flex w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white items-center">
                                                        <span class="text-center text-white w-full">
                                                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-label="SEKDAKAB">
                                                                <title>SEKDAKAB</title>
                                                                <path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="flex w-10 h-10 mx-auto bg-red-500 rounded-full text-lg text-white items-center">
                                                        <span class="text-center text-white w-full">
                                                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-label="SEKDAKAB">
                                                                <title>SEKDAKAB</title>
                                                                <path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="w-1/4">
                                            <div class="relative mb-2">
                                                <div class="absolute flex align-center items-center align-middle content-center"
                                                     style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                                                    <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                                        @if($usulan_pegawai->pivot->status_pemda == 1)
                                                            <div class="w-0 bg-green-300 py-1 rounded" style="width: 100%;"></div>
                                                        @else
                                                            <div class="w-0 bg-green-300 py-1 rounded" style="width: 0%;"></div>
                                                        @endif
                                                    </div>
                                                </div>

                                                @if(is_null($usulans->nomor_pertek))
                                                    <div class="flex w-10 h-10 mx-auto bg-white rounded-full text-lg text-white items-center border-2 border-gray-200 ">
                                                        <span class="text-center text-gray-600 w-full">
                                                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-label="SELESAI">
                                                                <title>SELESAI</title>
                                                                <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="flex w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white items-center">
                                                        <span class="text-center text-white w-full">
                                                            <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-label="SELESAI">
                                                                <title>SELESAI</title>
                                                                <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-2 text-center"><i>Data tidak ditemukan!</i></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

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

<script>
    // display a modal (small modal)
    $(document).on('click', '#smallButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href
            , beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#smallModal').modal("show");
                $('#smallBody').html(result).show();
            }
            , complete: function() {
                $('#loader').hide();
            }
            , error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            }
            , timeout: 8000
        })
    });

</script>
