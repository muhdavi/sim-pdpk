<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex">
                        <span class="flex border border-2 rounded-md px-2 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                            @if($pegawai->foto)
                                <img class="h-40 w-40 inline rounded-full" src="{{ URL::to('/')}}/foto/{{ $pegawai->foto }}" alt="Pasfoto">
                            @else
                                <p class="text-center text-red-500">Pasfoto belum diupload!</p>
                            @endif
                        </span>
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Nomor Induk Kontrak</span>
                        @if(!empty($pegawai->nk))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ $pegawai->nk }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Nomor Induk Kependudukan (NIK)</span>
                        @if(!empty($pegawai->nik))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ $pegawai->nik }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    @if($pegawai->nuptk)
                        <div class="flex mt-2">
                            <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">NUPTK</span>
                            @if(!empty($pegawai->nuptk))
                                <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ $pegawai->nuptk }}
                            </span>
                            @else
                                <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                            @endif
                        </div>
                    @endif

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Nomor Pokok Wajib Pajak (NPWP)</span>
                        @if(!empty($pegawai->npwp))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ $pegawai->npwp }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Nama Lengkap</span>
                        @if($pegawai->gelar_depan and $pegawai->gelar_belakang)
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                {{ $pegawai->gelar_depan }} {{ strtoupper($pegawai->nama) }}, {{ $pegawai->gelar_belakang }}
                            </span>
                        @elseif($pegawai->gelar_belakang)
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                {{ strtoupper($pegawai->nama) }}, {{ $pegawai->gelar_belakang }}
                            </span>
                        @elseif($pegawai->gelar_depan)
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                {{ $pegawai->gelar_depan }} {{ strtoupper($pegawai->nama) }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                {{ strtoupper($pegawai->nama) }}
                            </span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Tempat, Tanggal Lahir</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                            {{ ucwords($pegawai->tempat_lahir) }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d', $pegawai->tanggal_lahir)->format('d-m-Y') }}
                        </span>
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Jenis Kelamin</span>
                        @if($pegawai->jenis_kelamin == 1)
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">Laki-laki</span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">Perempuan</span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Alamat</span>
                        @if(!empty($pegawai->alamat))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                {{ ucwords($pegawai->alamat) }} @if(!empty($pegawai->kecamatan))Kecamatan {{ $pegawai->kecamatan->kecamatan }}@endif
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>
                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Nomor HP</span>
                        @if(!empty($pegawai->no_hp))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ $pegawai->no_hp }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">E-Mail</span>
                        @if(!empty($pegawai->email))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ $pegawai->email }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Jenis Tenaga Kontrak</span>
                        @if(!empty($pegawai->jenis_tenaga_kontrak_id))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ $pegawai->jenis_kontrak->jenis_tenaga_kontrak }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Honorarium</span>
                        @if(!empty($pegawai->honorarium))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    Rp. {{ number_format($pegawai->honorarium, 2) }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Tingkat Pendidikan</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $pegawai->pendidikan->pendidikan }}</span>
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Nama Sekolah/Perguruan Tinggi</span>
                        @if(!empty($pegawai->institusi))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ strtoupper($pegawai->institusi) }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Jurusan/Program Studi</span>
                        @if(!empty($pegawai->jurusan))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ strtoupper($pegawai->jurusan) }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Nomor Ijazah</span>
                        @if(!empty($pegawai->nomor_ijazah))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ $pegawai->nomor_ijazah }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>
                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Tanggal Lulus</span>
                        @if(!empty($pegawai->tanggal_lulus))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $pegawai->tanggal_lulus)->format('d-m-Y') }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Terhintung Mulai Tanggal (TMT)</span>
                        @if(!empty($pegawai->tmt))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $pegawai->tmt)->format('d-m-Y') }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Satuan Kerja</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                            {{ strtoupper($pegawai->unit_kerja->satuan_kerja->satuan_kerja) }}
                        </span>
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Unit Kerja</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                            {{ strtoupper($pegawai->unit_kerja->unit_kerja) }}
                        </span>
                    </div>

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Masa Kerja</span>
                        @if(!empty($pegawai->tmt))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ \Carbon\Carbon::parse($pegawai->tmt)->diff(\Carbon\Carbon::now())->format('%y Tahun %m Bulan') }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

                    @if(!empty($pegawai->jabatan))
                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Jabatan</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $pegawai->jabatan }}</span>
                    </div>
                    @endif

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Status</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                            @if($pegawai->status == 0)
                                {{ __('Perencanaan') }}
                            @elseif($pegawai->status == 1)
                                {{ __('Aktif') }}
                            @else
                                {{ __('Nonaktif') }}
                            @endif
                        </span>
                    </div>
                    
                    
                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Vaksin Pertama</span>
                        @if($pegawai->vaksin_pertama == 0)
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                            {{ __('Belum') }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-green-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                            {{ __('Sudah') }}
                            </span>
                        @endif
                    </div>
                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Vaksin Kedua</span>
                        @if($pegawai->vaksin_kedua == 0)
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                            {{ __('Belum') }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-green-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                            {{ __('Sudah') }}
                            </span>
                        @endif
                    </div>
                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Vaksin Pertama</span>
                        @if($pegawai->vaksin_ketiga == 0)
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                            {{ __('Belum') }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-green-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                            {{ __('Sudah') }}
                            </span>
                        @endif
                    </div>
                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Nomor SPKK</span>
                        @if(!empty($pegawai->spkk))
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                    {{ $pegawai->spkk }}
                            </span>
                        @else
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-red-200 w-max whitespace-no-wrap font-bold text-red-800 mx-2">
                                {{ __('Data tidak ditemukan!') }}
                            </span>
                        @endif
                    </div>

{{--                    @if(empty($pegawai->by))
                        <div class="flex mt-2">
                            <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Updated oleh</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                                {{ strtoupper($pegawai->operator->name) }}
                            </span>
                        </div>
                    @endif--}}

                    <div class="flex mt-2">
                        <span class="flex-none border border-2 rounded-md px-4 py-2 bg-gray-300 w-80 text-right">Dokumen</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                            @if($pegawai->ktp)
                                <a class="flex px-4 text-sm text-gray-600 font-bold hover:text-gray-900 underline" target="_blank" href="{{URL::to('/')}}/ktp/{{ $pegawai->ktp }}">
                                    {{ __('File KTP') }}
                                </a>
                            @else
                                <button class="flex pr-4 text-sm text-red-600 font-bold hover:text-red-900" disabled="true" >File KTP</button>
                            @endif

                            @if($pegawai->kk)
                                <a class="flex px-4 underline text-sm text-gray-600 font-bold hover:text-gray-900" target="_blank" href="{{URL::to('/')}}/kk/{{ $pegawai->kk }}">
                                    {{ __('File KK') }}
                                </a>
                            @else
                                <button class="flex px-4 text-sm text-red-600 font-bold hover:text-red-900" disabled="true" >File KK</button>
                            @endif


                            @if($pegawai->str and $pegawai->ijazah)
                                <a class="flex px-4 underline text-sm text-gray-600 font-bold hover:text-gray-900" target="_blank" href="{{URL::to('/')}}/ijazah/{{ $pegawai->ijazah }}">
                                    {{ __('File Ijazah') }}
                                </a>
                                <a class="flex underline text-sm text-gray-600 font-bold hover:text-gray-900" target="_blank" href="{{URL::to('/')}}/str/{{ $pegawai->str }}">
                                    {{ __('File STR') }}
                                </a>
                            @elseif($pegawai->ijazah)
                                    <a class="flex pl-4 underline text-sm text-gray-600 font-bold hover:text-gray-900" target="_blank" href="{{URL::to('/')}}/ijazah/{{ $pegawai->ijazah }}">
                                    {{ __('File Ijazah') }}
                                </a>
                            @else
                                <button class="flex pl-4 text-sm text-red-600 font-bold hover:text-red-900" disabled="true" >File Ijazah</button>
                            @endif
                        </span>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                           href="{{ URL::previous() }}">
                            {{ __('KEMBALI') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
