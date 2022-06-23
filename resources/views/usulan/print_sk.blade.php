<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>SIM-PDPK</title>
    
    <style type="text/css">
        body {
            font-size: 12pt;
        }
        @page {
            margin: 2cm 2cm 1cm 5cm;
            size: 33cm 21.5cm ;
        }
        header {
            float: right;
            width: 100%;
            border: 1px solid white;
        }
        main {
            clear: right;
            float: none;
            border: 1px solid white;
            margin: 25px 0;
        }
        footer {
            float: right;
            page-break-inside: avoid;
            border: 1px solid white;
            width: 100%;
        }
        table.data td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        
        table.data th {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        
        table.data {
            border-collapse: collapse;
            width: 100%;
        }
        
        table.data .no {
            width: 10px;
            padding: 5px;
            text-align: center;
        }
        table.data .nrk {
            width: 15%;
            padding: 5px;
            text-align: center;
        }
        table.data .nama {
            width: auto;
            padding: 5px;
            text-align: center;
        }
        table.data .dt_nama {
            width: auto;
            padding: 5px;
        }
        table.data .ttl {
            width: auto;
            padding: 5px;
            text-align: center;
        }
        table.data .dt_ttl {
            width: auto;
            padding: 5px;
        }
        table.data .pendidikan {
            width: 15%;
            padding: 5px;
            text-align: center;
        }
        table.head {
            float: right;
            width: 35%;
            border: 1px solid white;
        }
        table.foot {
            float: right;
            width: 35%;
            border: 1px solid white;
        }
        .center {
            text-align: center;
        }
        .right {
            text-align: right;
        }
        p {
            line-height: 0.2;
        }
        .tanggal {
            border-bottom: 1px solid black;
            border-collapse: collapse;
        }
        .ttd {
            padding: 30px 0;
        }
        .qrcode {
            float: left;
        }
    </style>
</head>
<body>
    
<script type="text/php">
    if ( isset($pdf) ) {
        // v.0.7.0 and greater
        $text = "Halaman {PAGE_NUM}/{PAGE_COUNT}";
        $font = $fontMetrics->get_font("helvetica", "bold");
        $size = 12;
        $color = array(0,0,0);

        $textWidth = $fontMetrics->getTextWidth($text, $font, $size);
        $x = $pdf->get_width() - 130;
        $y = $pdf->get_height() - 20;

        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;       //  default

        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>


<header>
    <table class="head">
        <tr>
            <td colspan="4" class="right">LAMPIRAN KEPUTUSAN</td>
        </tr>
        <tr>
            <td colspan="4" class="right"> {{ strtoupper($satuan_kerja->nama_jabatan) }} </td>
        </tr>
        <tr>
            <td></td>
            <td>NOMOR</td>
            <td>: </td>
            <td class="right">/{{ date('Y') }}</td>
        </tr>
        <tr>
            <td></td>
            <td>TANGGAL</td>
            <td class="tanggal">:</td>
            <td class="tanggal right">{{ date('Y') }} M</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td class="right">1443 H</td>
        </tr>
    </table>
</header>

<main>
    <p class="center">TENAGA KONTRAK PADA {{ strtoupper($satuan_kerja->satuan_kerja) }}</p>
    <p class="center">KABUPATEN ACEH TIMUR TAHUN {{ date('Y') }}</p>
    <table class="data">
        <thead>
        <tr>
            <td class="no">NO</td>
            <td class="nrk">NRK</td>
            <td class="nama">NAMA</td>
            <td class="ttl">TEMPAT/TANGGAL LAHIR</td>
            @if($satuan_kerja->id == 4 or $satuan_kerja->id == 12)
            <td class="ttl">UNIT KERJA</td>
            @endif
            <td class="pendidikan">PENDIDIKAN</td>
        </tr>
        </thead>
        @php($no = 0)
        @foreach($data_pdpk as $dt)
            <tr>
                <td class="no">{{ $no += 1 }}</td>
                <td class="nrk">{{ $dt->nk }}</td>
                <td class="dt_nama">
                    @if($dt->gelar_depan and $dt->gelar_belakang)
                        {{ $dt->gelar_depan }} {{ strtoupper($dt->nama) }}, {{ $dt->gelar_belakang }}
                    @elseif($dt->gelar_belakang)
                        {{ strtoupper($dt->nama) }}, {{ $dt->gelar_belakang }}
                    @elseif($dt->gelar_depan)
                        {{ $dt->gelar_depan }} {{ strtoupper($dt->nama) }}
                    @else
                        {{ strtoupper($dt->nama) }}
                    @endif
                </td>
                <td class="dt_ttl">{{ strtoupper($dt->tempat_lahir) }}/{{ date('d-m-Y', strtotime($dt->tanggal_lahir)) }}</td>
                @if($satuan_kerja->id == 4 or $satuan_kerja->id == 12)
                <td class="dt_ttl">{{ strtoupper($dt->unit_kerja->unit_kerja) }}</td>
                @endif
                <td class="pendidikan">{{ $dt->pendidikan->pendidikan }}</td>
            </tr>
        @endforeach
    </table>
</main>

<footer>
    <img class="qrcode" src="data:image/png;base64, {!! $qrcode !!}">
    <table class="foot">
        <tr>
            <td class="center">{{ strtoupper($satuan_kerja->nama_jabatan) }},</td>
        </tr>
        <tr>
            <td class="ttd"></td>
        </tr>
        <tr>
            <td class="center">{{ strtoupper($satuan_kerja->nama_kepala) }}</td>
        </tr>
    </table>
</footer>

</body>
</html>