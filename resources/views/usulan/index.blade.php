<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Usulan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    @if (session()->has('message'))
                        <div class="flex bg-green-300 px-4 py-3 mt-3" role="alert">
                            <div class="p-2">
                                <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 512 512">
                                    <path
                                        d="M468.907 214.604c-11.423 0-20.682 9.26-20.682 20.682v20.831c-.031 54.338-21.221 105.412-59.666 143.812-38.417 38.372-89.467 59.5-143.761 59.5h-.12C132.506 459.365 41.3 368.056 41.364 255.883c.031-54.337 21.221-105.411 59.667-143.813 38.417-38.372 89.468-59.5 143.761-59.5h.12c28.672.016 56.49 5.942 82.68 17.611 10.436 4.65 22.659-.041 27.309-10.474 4.648-10.433-.04-22.659-10.474-27.309-31.516-14.043-64.989-21.173-99.492-21.192h-.144c-65.329 0-126.767 25.428-172.993 71.6C25.536 129.014.038 190.473 0 255.861c-.037 65.386 25.389 126.874 71.599 173.136 46.21 46.262 107.668 71.76 173.055 71.798h.144c65.329 0 126.767-25.427 172.993-71.6 46.262-46.209 71.76-107.668 71.798-173.066v-20.842c0-11.423-9.259-20.683-20.682-20.683z"/>
                                    <path
                                        d="M505.942 39.803c-8.077-8.076-21.172-8.076-29.249 0L244.794 271.701l-52.609-52.609c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.077-8.077 21.172 0 29.249l67.234 67.234a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058L505.942 69.052c8.077-8.077 8.077-21.172 0-29.249z"/>
                                </svg>
                            </div>
                            <span class="text-lg font-bold ml-3 my-auto">{{ session('message') }}</span>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="flex bg-red-300 px-4 py-3 mt-3" role="alert">
                            <div class="p-2">
                                <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 512 512">
                                    <path
                                        d="M437.019 74.981C388.667 26.629 324.38 0 256 0S123.333 26.63 74.981 74.981 0 187.62 0 256s26.629 132.667 74.981 181.019C123.332 485.371 187.62 512 256 512s132.667-26.629 181.019-74.981C485.371 388.667 512 324.38 512 256s-26.629-132.668-74.981-181.019zM256 470.636C137.65 470.636 41.364 374.35 41.364 256S137.65 41.364 256 41.364 470.636 137.65 470.636 256 374.35 470.636 256 470.636z"
                                        fill="#FFF"/>
                                    <path
                                        d="M341.22 170.781c-8.077-8.077-21.172-8.077-29.249 0L170.78 311.971c-8.077 8.077-8.077 21.172 0 29.249 4.038 4.039 9.332 6.058 14.625 6.058s10.587-2.019 14.625-6.058l141.19-141.191c8.076-8.076 8.076-21.171 0-29.248z"
                                        fill="#FFF"/>
                                    <path
                                        d="M341.22 311.971l-141.191-141.19c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.076-8.077 21.171 0 29.248l141.19 141.191a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058c8.075-8.077 8.075-21.172-.001-29.249z"
                                        fill="#FFF"/>
                                </svg>
                            </div>
                            <span class="text-lg font-bold ml-3 my-auto">{{ session('error') }}</span>
                        </div>
                    @endif

                    @hasrole('Admin')
                        <a href="{{ route('usulan.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-2 float-right">
                            Buat Usulan
                        </a>
                    @endhasrole

                    <table class="table-fixed w-full mt-4">
                        <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-white w-16 ">No</th>
                            <th class="px-4 py-2 text-white">Periode</th>
                            @hasanyrole('Verifikator|Admin')
                            <th class="px-4 py-2 text-white w-80">Satuan Kerja</th>
                            @endhasanyrole
                            <th class="px-4 py-2 text-white">Nomor</th>
                            <th class="px-4 py-2 text-white">Tanggal</th>
                            <th class="px-4 py-2 text-white">Jumlah</th>
                            <th class="px-4 py-2 text-white">Jenis</th>
                            <th class="px-4 py-2 text-white text-center w-28">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @php($no=$i)
                        @forelse($usulans as $usulan)
                            <tr>
                                <td class="text-center">{{ $no += 1 }}</td>
                                <td class="text-center">{{ $usulan->periode->periode }}</td> {{-- ({{ date('M', strtotime($usulan->periode->periode_awal)) }} s.d. {{ date('M', strtotime($usulan->periode->periode_akhir)) }}) --}}
                                @hasanyrole('Verifikator|Admin')
                                <td class="text-left w-96">{{ $usulan->satuan_kerja->satuan_kerja }}</td>
                                @endhasanyrole
                                <td class="text-center">{{ $usulan->nomor_agenda }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($usulan->tanggal)) }} </td>
                                <td class="text-center">{{ $usulan->pegawai->whereNotIn('status',['2'])->count() }} </td>
                                <td class="text-center">
                                    @if($usulan->jenis_kebutuhan == 1)
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-green-600 rounded-full">{{ __('Perpanjangan') }}</span>
                                    @else
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-yellow-600 rounded-full">{{ __('Pengusulan Baru') }}</span>
                                    @endif
                                </td>
                                <td class="px-2 py-2 text-gray-500">
                                    <div class="flex space-x-2 float-right">
                                        <button onclick="window.location='{{ route('usulan.show', $usulan->id) }}'"
                                                class="border-2 border-black-200 rounded-md p-1 hover:bg-green-300"
                                                title="Lihat Usulan">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor" class="h-4 w-4 text-gray-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                        @if(is_null($usulan->nomor_pertek))
                                            @if($usulan->pegawai->count() == 0)
                                                <button
                                                    onclick="window.location='{{ route('usulan.pegawai', $usulan->id) }}'"
                                                    class="border-2 border-black-200 rounded-md p-1 hover:bg-green-300"
                                                    title="Tambah Pegawai">
                                                    <svg viewBox="0 0 24 24" stroke="currentColor" fill="none"
                                                         class="h-4 w-4 text-gray-500">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                </button>
                                                {{--<button onclick="window.location='{{ route('usulan.edit', $usulan->id) }}'" class="border-2 border-black-200 rounded-md p-1 hover:bg-green-300" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-gray-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                </button>--}}
                                            @else
                                                <button
                                                    onclick="window.open('{{ route('usulan.print', $usulan->id) }}', '_blank')"
                                                    class="border-2 border-black-200 rounded-md p-1 hover:bg-green-300"
                                                    title="Cetak Usulan">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-4 w-4 text-gray-500 icon icon-tabler icon-tabler-printer"
                                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                                         stroke-linejoin="round">
                                                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                                        <path
                                                            d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"/>
                                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"/>
                                                        <rect x="7" y="13" width="10" height="8" rx="2"/>
                                                    </svg>
                                                </button>
                                            @endif
                                            @hasanyrole('Verifikator')
                                            <button
                                                onclick="window.location='{{ route('usulan.verifikasi', $usulan->id) }}'"
                                                class="border-2 border-black-200 rounded-md p-1 hover:bg-green-300"
                                                title="Periksa Usulan">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor" class="h-4 w-4 text-gray-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </button>
                                            @endhasanyrole
                                            @hasanyrole('Admin')
                                            <button
                                                onclick="window.location='{{ route('usulan.pertek', $usulan->id) }}'"
                                                class="border-2 border-black-200 rounded-md p-1 hover:bg-green-300"
                                                title="Input Pertek">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor" class="h-4 w-4 text-gray-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </button>
                                            @endhasanyrole
                                        @else
                                            @unlessrole('Verifikator')
                                            <button
                                                onclick="window.open('{{ route('usulan.print.sk', $usulan->id) }}', '_blank')"
                                                class="border-2 border-green-500 bg-green-300 rounded-md p-1 hover:bg-green-500"
                                                title="Cetak SK">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-4 w-4 text-gray-500 icon icon-tabler icon-tabler-printer"
                                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                                    <path
                                                        d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"/>
                                                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"/>
                                                    <rect x="7" y="13" width="10" height="8" rx="2"/>
                                                </svg>
                                            </button>
                                            @endunlessrole
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                @hasrole('Kepegawaian')
                                <td colspan="7" class="py-2 px-4 text-center"><i>Data tidak ditemukan.</i></td>
                                @else
                                    <td colspan="8" class="py-2 px-4 text-center"><i>Data tidak ditemukan.</i></td>
                                    @endhasrole
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <hr/>
                    <div class="m-3">{{ $usulans->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
