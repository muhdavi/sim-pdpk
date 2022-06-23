<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah DPA') }}
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
                    <form method="POST" action="{{ route('dpa.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label class="tracking-wide mb-2" for="nomor_dpa" :value="__('Nomor DPA')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="nomor_dpa" name="nomor_dpa" required autofocus placeholder="DPA/A.1/2.18.5.06.0.00.01.0000/001/2021"/>
                            </div>
                        </div>

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3">
                                <x-label class="tracking-wide mb-2" for="nomor_rekening" :value="__('Nomor Rekening')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="nomor_rekening" name="nomor_rekening" required autofocus placeholder="5.1.02.02.01.0026"/>
                            </div>
                        </div>

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label class="tracking-wide mb-2" for="uraian" :value="__('Uraian')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="uraian" name="uraian" required autofocus placeholder="Belanja Jasa Tenaga Administrasi"/>
                            </div>
                        </div>

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label class="tracking-wide mb-2" for="file_dpa" :value="__('Upload File DPA')"/>
                                <x-input class="appearance-none block w-full border-black py-2 px-4 custom-file-input mb-1" type="file" id="file_dpa" name="file_dpa" required/>
                                <p class="text-grey-dark text-xs italic">File DPA yang diupload harus dalam format PDF.</p>
                            </div>
                        </div>
                        
                        <div class="-mx-3 md:flex my-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label class="tracking-wide mb-2" for="sekolah" :value="__('Kouta SD/SMP/SMA/Sederajat')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="sekolah" name="sekolah" required autofocus placeholder="0"/>
                                <p class="text-grey-dark text-xs italic">Jika kouta formasi tidak tersedia, isi dengan angka 0 (nol).</p>
                            </div>
                            
                            <div class="md:w-1/2 px-3">
                                <x-label class="tracking-wide mb-2" for="akademi" :value="__('Kouta D-I/D-II/D-III')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="akademi" name="akademi" required autofocus placeholder="0"/>
                                <p class="text-grey-dark text-xs italic">Jika kouta formasi tidak tersedia, isi dengan angka 0 (nol).</p>
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label class="tracking-wide mb-2" for="sarjana" :value="__('Kouta D-IV/S-1/S-2/S-3')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="sarjana" name="sarjana" required autofocus placeholder="0"/>
                                <p class="text-grey-dark text-xs italic">Jika kouta formasi tidak tersedia, isi dengan angka 0 (nol).</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
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
    </div>
</x-app-layout>
