<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Usul Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('usulan.pegawai.store') }}">
                    @csrf
                    <input type="hidden" name="usulan_id" value="{{ $usulan }}"/>

                    <table class="table-fixed w-full mt-4">
                    <thead class="bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-white w-16 ">No</th>
                        <th class="px-4 py-2 text-white">NIK</th>
                        <th class="px-4 py-2 text-white">Nama</th>
                        <th class="px-4 py-2 text-white">Tempat, Tanggal Lahir</th>
                        <th class="px-4 py-2 text-white">Pendidikan</th>
                        <th class="px-4 py-2 text-white">Usulkan?</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @php($no=0)
                    @forelse($pegawais as $pegawai)
                        <tr>
                            <td class="text-center">{{ $no = $no + 1 }}</td>
                            <td class="text-center">{{ $pegawai->nik }}</td>
                            <td>{{ ucwords($pegawai->nama) }}</td>
                            <td>{{ ucwords($pegawai->tempat_lahir) }}, {{ Date('d-m-Y', strtotime($pegawai->tanggal_lahir)) }}</td>
                            <td class="text-center">{{ $pegawai->pendidikan->pendidikan }}</td>
                            <td class="px-4 py-2 text-center">
                                <input type="checkbox" name="pegawai[]" value="{{ $pegawai->id }}" class="form-checkbox h-5 w-5 text-indigo-600">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-2 px-4 text-center"><i>Data tidak ditemukan!</i></td>
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
