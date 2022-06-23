<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Usulan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

{{--            resource:    https://tailwindcomponents.com/component/alerts-components-with-tailwindcss--}}
                @if(count($errors) > 0)
                <div class="flex bg-red-300 px-4 py-3 my-3" role="alert">
                    <div class="p-2">
                        <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M437.019 74.981C388.667 26.629 324.38 0 256 0S123.333 26.63 74.981 74.981 0 187.62 0 256s26.629 132.667 74.981 181.019C123.332 485.371 187.62 512 256 512s132.667-26.629 181.019-74.981C485.371 388.667 512 324.38 512 256s-26.629-132.668-74.981-181.019zM256 470.636C137.65 470.636 41.364 374.35 41.364 256S137.65 41.364 256 41.364 470.636 137.65 470.636 256 374.35 470.636 256 470.636z" fill="#FFF"/>
                            <path d="M341.22 170.781c-8.077-8.077-21.172-8.077-29.249 0L170.78 311.971c-8.077 8.077-8.077 21.172 0 29.249 4.038 4.039 9.332 6.058 14.625 6.058s10.587-2.019 14.625-6.058l141.19-141.191c8.076-8.076 8.076-21.171 0-29.248z" fill="#FFF"/>
                            <path d="M341.22 311.971l-141.191-141.19c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.076-8.077 21.171 0 29.248l141.19 141.191a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058c8.075-8.077 8.075-21.172-.001-29.249z" fill="#FFF"/>
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
                    <form method="POST" action="{{ route('usulan.store') }}">
                        @csrf
                        <input type="hidden" name="periode_id" value="{{ $periode->id }}">

                        <div class="flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Periode</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 whitespace-no-wrap font-bold text-blue-800 mx-2">{{ $periode->periode }}</span>
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Tanggal Mulai Kontrak</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 whitespace-no-wrap font-bold text-blue-800 mx-2">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $periode->periode_awal)->format('d-m-Y') }}</span>
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Tanggal Selesai Kontrak</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 whitespace-no-wrap font-bold text-blue-800 mx-2">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $periode->periode_akhir)->format('d-m-Y') }}</span>
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Jenis Usulan</span>
                            <div class="relative inline-flex mx-2">
                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                    <path fill="#648299" fill-rule="nonzero"
                                          d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" />
                                </svg>
                                <select class="border border-gray-300 rounded-md text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none"
                                        name="jenis_kebutuhan" autofocus>
                                    @if(Auth::user()->satuan_kerja_id == 4)
                                    <option value="1">Perpanjangan</option>
                                    @endif
                                    <option value="0">Pengangkatan Baru</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex mt-4">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Nomor Agenda Usulan</span>
                            <x-input class="flex w-80 mx-2" type="text" name="nomor_agenda" required autofocus />
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Perihal</span>
                            <x-input class="flex w-8/12 mx-2" type="text" name="perihal" required autofocus />
                        </div>

                        <div class="mt-4 flex">
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-300 w-60">Tanggal</span>
                            <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 whitespace-no-wrap font-bold text-blue-800 mx-2">{{ date('d-m-Y') }}</span>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition"
                               href="{{ URL::previous() }}">
                                {{ __('BATAL') }}
                            </a>
                            <x-button class="ml-3">
                                {{ __('BUAT USULAN') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $( function() {
        var dateFormat = "yy-mm-dd",
            from = $( "#periode_awal" )
                .datepicker({
                    defaultDate: "+1w",
                    numberOfMonths: 3,
                    dateFormat: 'yy-mm-dd',
                })
                .on( "change", function() {
                    to.datepicker( "option", "minDate", getDate( this ) );
                }),
            to = $( "#periode_akhir" ).datepicker({
                defaultDate: "+1w",
                numberOfMonths: 3,
                dateFormat: 'yy-mm-dd',
            })
                .on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
                });

        function getDate( element ) {
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
                date = null;
            }
            return date;
        }
    } );
</script>
