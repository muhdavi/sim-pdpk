<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Isi Pertimbangan Teknis') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Periode</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $usulans->periode->periode }}</span>
                    </div>

                    <div class="mt-4 flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Tanggal Mulai Kontrak</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ date('d-m-Y', strtotime($usulans->periode->periode_awal)) }}</span>
                    </div>

                    <div class="mt-4 flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Tanggal Selesai Kontrak</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ date('d-m-Y', strtotime($usulans->periode->periode_akhir)) }}</span>
                    </div>

                    <div class="flex mt-4">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Nomor Agenda Usulan</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ $usulans->nomor_agenda }}</span>
                    </div>

                    <div class="flex mt-4">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Jenis Usulan</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">
                            @if($usulans->jenis_kebutuhan == 1)
                                {{ __('Perpanjangan') }}
                            @else
                                {{ __('Pengusulan Baru') }}
                            @endif
                        </span>
                    </div>

                    <div class="mt-4 flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Tanggal</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ date('d-m-Y', strtotime($usulans->tanggal)) }}</span>
                    </div>

                    <div class="mt-4 flex">
                        <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Perihal</span>
                        <span class="flex border border-2 rounded-md px-4 py-2 bg-gray-200 w-max whitespace-no-wrap font-bold text-black-800 mx-2">{{ ucwords($usulans->perihal) }}</span>
                    </div>
                    
                    @if($status_pemda->count() > 0)
                    <form method="POST" action="{{ route('usulan.pertek.store', $usulans->id) }}">
                        @csrf
                        <input type="hidden" name="usulan_id" value="{{ $usulans->id }}"/>
                        <div class="flex mt-4">
                            <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Nomor Pertimbangan Teknis</span>
                            <input class="flex border border-2 rounded-md px-4 py-2 w-max whitespace-no-wrap font-bold text-black-800 mx-2" type="text"  id="nomor_pertek", name="nomor_pertek" />
                        </div>
    
                        <div class="flex mt-4">
                            <span class="flex-none text-right border border-2 rounded-md px-4 py-2 bg-gray-300 w-64">Tanggal Pertimbangan Teknis</span>
                            <input class="flex border border-2 rounded-md px-4 py-2 w-max whitespace-no-wrap font-bold text-black-800 mx-2" type="text" id="tanggal_pertek", name="tanggal_pertek" />
                        </div>
                        
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
                    @else
                        <div class="flex items-center justify-end my-4 mx-4">
                            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition"
                                   href="{{ URL::previous() }}">
                                    {{ __('BATAL') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // display a modal (small modal)
    $(document).on('click', '#smallButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href
            , beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#smallModal').modal("show");
                $('#smallBody').html(result).show();
            }
            , complete: function() {
                $('#loader').hide();
            }
            , error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            }
            , timeout: 8000
        })
    });

</script>
