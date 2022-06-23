<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar DPA') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    @if (session()->has('message'))
                        <div class="flex bg-green-300 px-4 py-3 mt-3" role="alert">
                            <div class="p-2">
                                <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M468.907 214.604c-11.423 0-20.682 9.26-20.682 20.682v20.831c-.031 54.338-21.221 105.412-59.666 143.812-38.417 38.372-89.467 59.5-143.761 59.5h-.12C132.506 459.365 41.3 368.056 41.364 255.883c.031-54.337 21.221-105.411 59.667-143.813 38.417-38.372 89.468-59.5 143.761-59.5h.12c28.672.016 56.49 5.942 82.68 17.611 10.436 4.65 22.659-.041 27.309-10.474 4.648-10.433-.04-22.659-10.474-27.309-31.516-14.043-64.989-21.173-99.492-21.192h-.144c-65.329 0-126.767 25.428-172.993 71.6C25.536 129.014.038 190.473 0 255.861c-.037 65.386 25.389 126.874 71.599 173.136 46.21 46.262 107.668 71.76 173.055 71.798h.144c65.329 0 126.767-25.427 172.993-71.6 46.262-46.209 71.76-107.668 71.798-173.066v-20.842c0-11.423-9.259-20.683-20.682-20.683z"/>
                                    <path d="M505.942 39.803c-8.077-8.076-21.172-8.076-29.249 0L244.794 271.701l-52.609-52.609c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.077-8.077 21.172 0 29.249l67.234 67.234a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058L505.942 69.052c8.077-8.077 8.077-21.172 0-29.249z"/>
                                </svg>
                            </div>
                            <span class="text-lg font-bold ml-3 my-auto">{{ session('message') }}</span>
                        </div>
                    @endif
                    @hasrole('Kepegawaian')
                        <a href="{{ route('dpa.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-2 float-right">Tambah DPA</a>
                    @endhasrole

                    <table class="table-fixed w-full mt-4">
                        <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-white w-16 ">No</th>
                            @can('bkpsdm')<th class="px-4 py-2 text-white">Satuan Kerja</th>@endcan
                            <th class="px-4 py-2 text-white w-80">Nomor DPA</th>
                            <th class="px-4 py-2 text-white w-40">Status</th>
                            <th class="px-4 py-2 text-white w-40">Tanggal Update</th>
                            <th class="px-4 py-2 text-white w-20">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @php($no=$i)
                        @forelse($dpas as $dpa)
                            <tr>
                                <td class="text-center">{{ $no = $no + 1 }}</td>
                                @can('bkpsdm')<td>{{ $dpa->satuan_kerja->satuan_kerja }}</td>@endcan
                                <td class="text-center">{{ strtoupper($dpa->nomor_dpa) }}</td>
                                <td class="text-center">
                                    @if($dpa->status == 1)
                                        <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-green-600 rounded-full">{{ __('Masih Berlaku') }}</span>
                                    @elseif($dpa->status == 0)
                                        <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-yellow-600 rounded-full">{{ __('Belum Diverifikasi') }}</span>
                                    @else
                                        <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-gray-600 rounded-full">{{ __('Tidak Berlaku') }}</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($dpa->updated_at)) }}</td>
                                <td class="px-2 py-2 text-gray-500 text-center">
                                    <button onclick="window.location='{{ route('dpa.show', $dpa->id) }}'" class="border-2 border-black-200 rounded-md p-1 hover:bg-green-300" title="Lihat">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                @can('bkpsdm')
                                <td colspan="6" class="py-2 px-4 text-center"><i>Data tidak ditemukan.</i></td>
                                @else
                                <td colspan="5" class="py-2 px-4 text-center"><i>Data tidak ditemukan.</i></td>
                                @endcan
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <hr/>
                    <div class="m-3">{{ $dpas->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
