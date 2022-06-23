<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="jeniskelamin"></div>
                </div>
                
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="progress"></div>
                </div>
                
                
                <div class="bg-white border-b border-gray-200">
                    <table class="table-fixed w-full">
                        <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-white w-12 ">No</th>
                            <th class="px-4 py-2 text-white">Perangkat Daerah</th>
                            <th class="px-4 py-2 text-white w-40">Jumlah Formasi</th>
                            <th class="px-4 py-2 text-white w-36">Formasi Terisi</th>
                            <th class="px-4 py-2 text-white w-40">Formasi Kosong</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @php($no=0)
                        @foreach($data as $dt)
                            <tr v-for="row in rows">
                                <td class="odd:bg-white even:bg-gray-300 px-4 py-2 text-center">{{ $no = $no + 1 }}</td>
                                <td class="odd:bg-white even:bg-gray-300 ">{{ strtoupper($dt->satuan_kerja) }}</td>
                                <td class="odd:bg-white even:bg-gray-300 text-center">{{ $dt->kouta }}</td>
                                <td class="odd:bg-white even:bg-gray-300 text-center">{{ $dt->data_isi }}</td>
                                <td class="odd:bg-white even:bg-gray-300 text-center">{{ $dt->data_kosong }}</td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-gray-900">
                            <tr>
                                <th class="px-4 py-2 text-white" colspan="2">Jumlah</td>
                                <th class="px-4 py-2 text-white">{{ $jkouta }}</td>
                                <th class="px-4 py-2 text-white">{{ $jupdated }}</td>
                                <th class="px-4 py-2 text-white">{{ $jkouta-$jupdated }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    var pdpk_lk = <?php echo $pdpk_lk ?>;
    var pdpk_pr = <?php echo $pdpk_pr ?>;
    var tahun = 2021;
    
    Highcharts.chart('jeniskelamin', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: `Jumlah PDPK Kabupaten Aceh Timur Tahun ${tahun}`
    },
    subtitle: {
        text: `Berdasarkan Jenis Kelamin (Laki-laki: <b>${pdpk_lk}</b> | Perempuan: <b>${pdpk_pr}</b>)`
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Sebanyak',
        colorByPoint: true,
        data: [{
            name: 'Laki-laki',
            y: pdpk_lk,
            color: "#0090d0",
            sliced: true,
            selected: true
        }, {
            name: 'Perempuan',
            y: pdpk_pr,
            color: "#d7127a"
        }]
    }]
});


    var satuan_kerja = <?php echo $satuan_kerja ?>;
    var updated = <?php echo $updated ?>;
    var updating = <?php echo $updating ?>;
    var kouta = <?php echo $kouta ?>;
    
    Highcharts.chart('progress', {
    chart: {
        type: 'column'
    },
    title: {
        text: `Formasi PDPK Kabupaten Aceh Timur Tahun ${tahun}`
    },
    subtitle: {
        text: `Berdasarkan Perangkat Daerah`
    },
    xAxis: {
        categories: satuan_kerja,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah PDPK (orang)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f} PDPK</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [ {
        name: 'Jumlah Formasi',
        data: kouta
    }, {
        name: 'Formasi Terisi',
        data: updated,
        color: "#00FF00"
    }, {
        name: 'Formasi Kosong',
        data: updating
    }]
});
</script>

