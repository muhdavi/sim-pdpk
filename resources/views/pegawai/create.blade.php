<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                {{--            resource:    https://tailwindcomponents.com/component/alerts-components-with-tailwindcss--}}
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
                    <form method="POST" action="{{ route('pegawai.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                                <x-label class="tracking-wide mb-2" for="nik" :value="__('Nomor Induk Kependudukan (NIK)')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="nik" name="nik" autofocus placeholder="1103192012210001"/>
                            </div>
                        </div>

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label class="tracking-wide mb-2" for="gelar_depan" :value="__('Gelar Depan')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="gelar_depan" name="gelar_depan" autofocus placeholder="Prof. Dr."/>
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label class="tracking-wide mb-2" for="nama" :value="__('Nama Tanpa Gelar')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="nama" name="nama" required autofocus placeholder="Rumaisha Nasyauqi"/>
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label class="tracking-wide mb-2" for="gelar_belakang" :value="__('Gelar Belakang')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="gelar_belakang" name="gelar_belakang" autofocus placeholder="S.Kom., M.Kom."/>
                            </div>
                        </div>

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label class="tracking-wide mb-2" for="tempat_lahir" :value="__('Tempat Lahir')"/>
                                <x-input class="appearance-none block w-full py-3 px-4 mb-1" type="text" id="tempat_lahir" name="tempat_lahir" required autofocus placeholder="Aceh Timur"/>
                                <p class="text-grey-dark text-xs italic">Silahkan isi tempat lahir sesuai dengan yang tertulis di KTP.</p>
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label class="tracking-wide mb-2" for="tanggal_lahir" :value="__('Tanggal Lahir')"/>
                                <x-input class="appearance-none block w-full py-3 px-4" type="text" id="tanggal_lahir" name="tanggal_lahir" required autofocus placeholder="Tanggal Lahir"/>
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label class="tracking-wide mb-2" for="jenis_kelamin" :value="__('Jenis Kelamin')"/>
                                <div class="relative focus-within:text-gray-600 text-gray-400">
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" name="jenis_kelamin" value="1" class="form-radio h-5 w-5 text-blue-600" required autofocus/>
                                        <span class="ml-2 text-gray-700">Laki-laki</span>
                                    </label>
                                    <label class="inline-flex items-center mt-3 ml-5">
                                        <input type="radio" name="jenis_kelamin" value="0" class="form-radio h-5 w-5 text-pink-600" required autofocus/>
                                        <span class="ml-2 text-gray-700">Perempuan</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label class="tracking-wide mb-2" for="tingkat_pendidikan" :value="__('Tingkat Pendidikan')"/>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" name="pendidikan" id="pendidikan" required>
                                        <option value="-1">Pilih salah satu...</option>
                                        @foreach($pendidikans as $pendidikan)
                                            <option value="{{ $pendidikan->id }}">{{ $pendidikan->pendidikan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="md:w-full px-3">
                                <x-label class="tracking-wide mb-2" for="unit_kerja" :value="__('Unit Kerja')"/>
                                <select class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" name="unit_kerja" id="unit_kerja" required>
                                    <option value="-1">Pilih salah satu...</option>
                                    @foreach($unit_kerjas as $unit_kerja)
                                        <option value="{{ $unit_kerja->id }}">{{ $unit_kerja->unit_kerja }}</option>
                                    @endforeach
                                </select>
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
<script type="text/javascript">
  $('#unit_kerjas').select2({
    placeholder: 'Pilih salah satu...',
    ajax: {
      url: '/pegawai/unit-kerja-select',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.unit_kerja,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });

</script>
