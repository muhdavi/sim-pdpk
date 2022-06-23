<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar PDPK') }}
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
                    @hasrole('Admin')
                    <a href="{{ route('pegawai.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-2 float-right">Tambah PDPK</a>
                    @endhasrole
                    @canany(['bkpsdm','update pegawai'])
                        <form action="{{ url()->current() }}" method="get">
                            <div class="my-2 mx-4 relative text-gray-600 float-right">
                              <input type="search" name="keyword" value="{{ request('keyword') }}" placeholder="Ketik NIK atau Nama..." class="bg-white h-10 w-80 px-5 pr-10 rounded text-sm focus:outline-none">
                              <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                  <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                                </svg>
                              </button>
                            </div>
        				</form>
                    @endcanany

                    <table class="table-fixed w-full">
                        <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-white w-16 ">No</th>
                            <th class="px-4 py-2 text-white">NIK</th>
                            <th class="px-4 py-2 text-white">Nama</th>
                            <th class="px-4 py-2 text-white">Tempat, <br/>Tanggal Lahir</th>
                            <th class="px-4 py-2 text-white">Usia</th>
                            <th class="px-4 py-2 text-white">Pendidikan</th>
                            <th class="px-4 py-2 text-white">Status</th>
                            <th class="px-4 py-2 text-white w-20">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @php($no=$i)
                        @forelse($pegawais as $pegawai)
                            @if($pegawai->vaksin_kedua == 0 || isset($pegawai->skkp))
                                <tr class="bg-red-200">
                            @else
                                @if($no % 2 == 0)
                                    <tr class="bg-gray-200">

                                @else
                                    <tr>
                                @endif
                            @endif
                                <td class="text-center">{{ $no = $no + 1 }}</td>
                                <td class="text-center">{{ $pegawai->nik }}</td>
                                <td>{{ strtoupper($pegawai->nama) }}</td>
                                <td class="text-right">{{ ucwords($pegawai->tempat_lahir) }}, <br/>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $pegawai->tanggal_lahir)->format('d-m-Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->age }}</td>
                                <td class="text-center">{{ $pegawai->pendidikan->pendidikan }} </td>
                                <td class="text-center">
                                    @if($pegawai->status == 0)
                                        <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-yellow-600 rounded-full">{{ __('Perencanaan') }}</span>
                                    @elseif($pegawai->status == 1)
                                        <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-green-600 rounded-full">{{ __('Aktif') }}</span>
                                    @else
                                        <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-gray-600 rounded-full">{{ __('Nonaktif') }}</span>
                                    @endif
                                </td>
                                <td class="px-2 py-2 text-gray-500">
                                    <div class="flex space-x-2 float-right">
                                        <button onclick="window.location='{{ route('pegawai.show', $pegawai->id) }}'" class="border-2 border-black-200 rounded-md p-1 hover:bg-green-300" title="Lihat">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-gray-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                        @if($pegawai->status != 2)
                                        <button onclick="window.location='{{ route('pegawai.edit', $pegawai->id) }}'" class="border-2 border-black-200 rounded-md p-1 hover:bg-green-300" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-gray-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </button>
                                        @else
                                        <button onclick="window.location='{{ route('pegawai.edit', $pegawai->id) }}'" disabled="true" class="border-2 border-black-200 rounded-md p-1 hover:bg-black-200" title="Disable Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-gray-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </button>
                                        @endif
                                        {{--@hasrole('Adminn')
                                        <button onclick="window.location='{{ route('pegawai.destroy', $pegawai->id) }}'" class="border-2 border-black-200 rounded-md p-1 hover:bg-red-300" title="Non-aktif">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-gray-500">
                                                <path  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" />
                                            </svg>
                                        </button>
                                        @endhasrole
                                        <button onclick="window.location='{{ route('pegawai.edit', $pegawai->id) }}'" class="border-2 border-green-200 rounded-md p-1 hover:bg-green-700" title="Download">
                                            <svg class="h-4 w-4 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                            </svg>
                                        </button>--}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-2 px-4 text-center"><i>Data tidak ditemukan.</i></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <hr/>
                    <div class="m-3">{{ $pegawais->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
