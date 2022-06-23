<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail DPA') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(count($errors) > 0)
                    <div class="flex bg-red-300 px-4 py-3 my-3" role="alert">
                        <div class="p-2">
                            <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
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
                        <span class="text-lg font-bold ml-3 my-auto">
                        @foreach($errors->all() as $error)
                                <ul>
                                <li>{{ $error }}</li>
                            </ul>
                            @endforeach
                    </span>
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('dpa.update', $dpa->id) }}">
                        @csrf
                        <div class="flex">
                            <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-60 text-right">Nomor DPA</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $dpa->nomor_dpa }}</span>
                        </div>

                        <div class="flex mt-4">
                            <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-60 text-right">Nomor Rekening</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $dpa->nomor_rekening }}</span>
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-60 text-right">Uraian</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ ucwords($dpa->uraian) }}</span>
                        </div>
                        
                        <div class="mt-4 flex">
                            <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-60 text-right">Kouta Formasi</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-5/12 whitespace-no-wrap font-bold text-black-800 mx-2">SD/SMP/SMA/Sederajat: {{ $dpa->kouta_sekolah }}</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-5/12 whitespace-no-wrap font-bold text-black-800 mx-2">D-I/D-II/D-III: {{ $dpa->kouta_akademi }}</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-5/12 whitespace-no-wrap font-bold text-black-800 mx-2">D-IV/S-1/S-2/S-3: {{ $dpa->kouta_sarjana }}</span>
                        </div>

                        <div class="flex mt-4">
                            <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-60 text-right">Status</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                @if($dpa->status == 1)
                                    {{ __('Masih Berlaku') }}
                                @elseif($dpa->status == 0)
                                    {{ __('Belum Diverifikasi') }}
                                @else
                                    {{ __('Tidak Berlaku') }}
                                @endif
                            </span>
                        </div>

                        <div class="flex mt-2">
                            <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-full text-center font-bold ">Dokumen Pelaksanaan Anggaran</span>
                        </div>

                        <div class="flex mt-2">
                            <embed class="w-full h-96" src={{ URL::to('/')}}/dpa/{{ $dpa->file_dpa }} type="application/pdf">
                        </div>

                        @can('bkpsdm')
                        <div class="-mx-3 md:flex my-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label class="tracking-wide mb-2" for="sekolah" :value="__('Kouta SD/SMP/SMA/Sederajat')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="sekolah" name="sekolah" value="{{ $dpa->kouta_sekolah }}" required autofocus />
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label class="tracking-wide mb-2" for="akademi" :value="__('Kouta D-I/D-II/D-III')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="akademi" name="akademi" value="{{ $dpa->kouta_akademi }}" required autofocus />
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label class="tracking-wide mb-2" for="sarjana" :value="__('Kouta D-IV/S-1/S-2/S-3')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="sarjana" name="sarjana" value="{{ $dpa->kouta_sarjana }}" required autofocus />
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label class="tracking-wide mb-2" for="status_dpa" :value="__('Apakah DPA masih Berlaku?')"/>
                                <div class="relative focus-within:text-gray-600 text-gray-400">
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" name="status_dpa" value="1" class="form-radio h-5 w-5 text-blue-600" required autofocus/>
                                        <span class="ml-2 text-gray-700">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 ml-5">
                                        <input type="radio" name="status_dpa" value="2" class="form-radio h-5 w-5 text-pink-600" required autofocus/>
                                        <span class="ml-2 text-gray-700">Tidak</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endcan

                        <div class="flex items-center justify-end mt-2">
                            @can('bkpsdm')
                                <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition"
                                   href="{{ URL::previous() }}">
                                    {{ __('BATAL') }}
                                </a>
                                <x-button class="ml-3">
                                    {{ __('SIMPAN') }}
                                </x-button>
                            @else
                                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                   href="{{ URL::previous() }}">
                                    {{ __('KEMBALI') }}
                                </a>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
