<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verifikasi') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @can('verifikasi bkpsdm')
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex">
                        <span class="border border-2 rounded-md px-4 py-2 bg-gray-300 w-full mx-2 text-center font-extrabold">KOUTA FORMASI</span>
                    </div>
                    <div class="flex mt-2">
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-1/3 whitespace-no-wrap font-bold text-black-800 mx-2">SD/SMP/SMA/Sederajat: {{ $dpa->kouta_sekolah }}</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-1/3 whitespace-no-wrap font-bold text-black-800 mx-2">D-I/D-II/D-III/D-IV: {{ $dpa->kouta_akademi }}</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-1/3 whitespace-no-wrap font-bold text-black-800 mx-2">D-IV/S-1/S-2/S-3: {{ $dpa->kouta_sarjana }}</span>
                    </div>
                    <div class="flex mt-2">
                        <a class="border border-2 rounded-md px-4 py-2 bg-gray-300 w-full mx-2 text-center font-extrabold" target="_blank" href="{{URL::to('/')}}/dpa/{{ $dpa->file_dpa }}">Lihat File DPA</a>
                    </div>
                </div>
                @endcan
                <form method="POST" action="{{ route('usulan.verifikasi.store') }}">
                    @csrf
                    <input type="hidden" name="usulan_id" value="{{ $usulan }}"/>

                    <table class="table-fixed w-full">
                    <thead class="bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-white w-16 ">No</th>
                        <th class="px-4 py-2 text-white">NIK</th>
                        <th class="px-4 py-2 text-white">Nama</th>
                        @can('verifikasi gampong')
                        <th class="px-4 py-2 text-white">Alamat</th>
                        @endcan
                        @canany(['verifikasi bkpsdm', 'verifikasi pemda'])
                        <th class="px-4 py-2 text-white">Pendidikan</th>
                        @endcanany
                        <th class="px-4 py-2 text-white">Pasfoto</th>
                        <th class="px-4 py-2 text-white">Lulus?</th>
                        <th class="px-4 py-2 text-white text-center">Tolak?</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @php($no=0)
                    @forelse($pegawais as $pegawai)
                        <tr>
                            <td class="text-center">{{ $no = $no + 1 }}</td>
                            @canany(['verifikasi bkpsdm', 'verifikasi pemda'])
                            <td class="text-center">
                                <a href="{{ route('pegawai.show', $pegawai->id) }}" class="text-blue-700  inline-flex items-center font-semibold tracking-wide" target="_blank">
                                    <span class="hover:underline">
                                        {{ $pegawai->nik }}
                                    </span>
                                </a>
                            </td>
                            @else
                            <td class="text-center">{{ $pegawai->nik }}</td>
                            @endcanany
                            <td>
                                @if($pegawai->gelar_depan and $pegawai->gelar_belakang)
                                    {{ $pegawai->gelar_depan }} {{ strtoupper($pegawai->nama) }}, {{ $pegawai->gelar_belakang }}
                                @elseif($pegawai->gelar_belakang)
                                    {{ strtoupper($pegawai->nama) }}, {{ $pegawai->gelar_belakang }}
                                @elseif($pegawai->gelar_depan)
                                    {{ $pegawai->gelar_depan }} {{ strtoupper($pegawai->nama) }}
                                @else
                                    {{ strtoupper($pegawai->nama) }}
                                @endif
                            </td>
                            @can('verifikasi gampong')
                                <td class="text-center">{{ ucwords($pegawai->alamat) }}</td>
                            @endcan
                            @canany(['verifikasi bkpsdm', 'verifikasi pemda'])
                                <td class="text-center">{{ ucwords($pegawai->pendidikan->pendidikan) }}</td>
                            @endcanany
                            <td class="text-center">
                                <img alt="avatar" class="h-20 w-20 inline rounded-full border-2 border-gray-300" src="{{ URL::to('/')}}/foto/{{ $pegawai->foto }}" alt="Pasfoto" />
                            </td>
                            <td class="px-4 py-2 text-center">
                                <input type="checkbox" name="pegawai[]" value="{{ $pegawai->id }}" class="form-checkbox h-5 w-5 text-indigo-600">
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('pegawai.reject', $pegawai->id) }}" target="_blank"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md">TOLAK</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-2"><i>Data tidak ditemukan!</i></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <hr/>
                <div class="flex items-center justify-end my-4 mx-4">
                    <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition"
                       href="{{ URL::previous() }}">
                        {{ __('BATAL') }}
                    </a>
                    <x-button class="ml-3">
                        {{ __('SIMPAN') }}
                    </x-button>
                </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
