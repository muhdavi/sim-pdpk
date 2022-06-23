<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>SIM-PDPK</title>

    <style type="text/css">
        @page {
            margin: 0cm 0cm;
        }

        body, html {
            font-family: "Bookman Old Style", Arial, Helvetica, sans-serif;
            {{--background-image: url({{ asset("assets/images/kop.jpg") }});--}}
            background-repeat: no-repeat;
            background-position: center;
            padding: .5in .3in .3in .3in;
        }

        header {
            position: absolute;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2.5cm;

            /** Extra personal styles **/
            /*background-color: #03a9f4;*/
            color: black;
            text-align: center;
            padding: 10mm;
        }

        main {
            margin-top: 1.1in;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            /*background-color: #03a9f4;*/
            color: black;
            text-align: center;
            line-height: 1.5cm;
        }

        table {
            display: table;
            margin: 30px auto 10px auto;
            empty-cells: show;
        }
        
        h2 {
            line-height: 25px;
        }
        

        div.table {
            border: 1px solid black;
            border-collapse: collapse;
            display: table;
            margin: 20px auto 10px auto;
        }

        div.tr {
            border: 1px solid black;
            display: table-row;
            width: auto;
        }

        div.th {
            border: 1px solid black;
            display: table-cell;
            padding: 10px;
            background-color: lightgray;
            font-weight: bolder;
            text-align: center;
        }

        div.td {
            border: 1px solid black;
            display: table-cell;
            padding: 10px;
        }

        .center {
            text-align: center;
        }

        .margin-header {
            margin-top: 1.5cm;
        }
        
        .jarak_tengah {
            padding: 0 2cm;
        }
        
        .ttd {
            margin-top: 2cm;
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
            $x = $pdf->get_width() - 100;
            $y = $pdf->get_height() - 35;

            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;       //  default

            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }


</script>

<header>
    <h2>DAFTAR NAMA USULAN PENGANGKATAN TENAGA KONTRAK PADA {{ strtoupper($satuan_kerja->satuan_kerja) }} KABUPATEN ACEH TIMUR TAHUN ANGGARAN {{ date('Y') }}</h2>
</header>

<footer>{{ date('d-m-Y') }} &copy; {{ $verif }}</footer>

<main>
    <div class="table">
        <div class="tr">
            <div class="th">No</div>
            <div class="th">Nama</div>
            <div class="th">Tempat, Tanggal Lahir</div>
            <div class="th">Pendidikan</div>
            @if($satuan_kerja->id == 4 or $satuan_kerja->id == 12)
            <div class="th">Unit Kerja</div>
            @endif
            <div class="th">Keterangan</div>
        </div>
        <div class="tr center">
            <div class="th">(1)</div>
            <div class="th">(2)</div>
            <div class="th">(3)</div>
            <div class="th">(4)</div>
            <div class="th">(5)</div>
            @if($satuan_kerja->id == 4 or $satuan_kerja->id == 12)
            <div class="th">(6)</div>
            @endif
        </div>
        @php($no = 0)
        @forelse($data12s as $data12)
            <div class="tr">
                <div class="td center">{{ $no += 1 }}</div>
                {{--<div class="td center">{{ $data12->nik }}</div>--}}
                <div class="td">
                    @if($data12->gelar_depan and $data12->gelar_belakang)
                        {{ $data12->gelar_depan }} {{ strtoupper($data12->nama) }}, {{ $data12->gelar_belakang }}
                    @elseif($data12->gelar_belakang)
                        {{ strtoupper($data12->nama) }}, {{ $data12->gelar_belakang }}
                    @elseif($data12->gelar_depan)
                        {{ $data12->gelar_depan }} {{ strtoupper($data12->nama) }}
                    @else
                        {{ strtoupper($data12->nama) }}
                    @endif
                </div>
                <div class="td">{{ ucwords($data12->tempat_lahir) }}, {{ Date('d-m-Y', strtotime($data12->tanggal_lahir)) }}</div>
                <div class="td center">{{ $data12->pendidikan->pendidikan }}</div>
                @if($satuan_kerja->id == 4 or $satuan_kerja->id == 12)
                <div class="td">{{ $data12->unit_kerja->unit_kerja }}</div>
                @endif
                <div class="td">{{ $satuan_kerja->jumlah_bulan }} Bulan</div>
            </div>
        @empty
            <p class="center"><i>Data tidak ditemukan!</i></p>
        @endforelse
    </div>

    @if(!$data46s->isEmpty())
        <div class="margin-header"></div>
        <div class="table">
            <div class="tr">
                <div class="th">No</div>
                <div class="th">NIK</div>
                <div class="th">Nama</div>
                <div class="th">Pendidikan</div>
                <div class="th">Unit Kerja</div>
                <div class="th">Keterangan</div>
            </div>
            <div class="tr center">
                <div class="td">(1)</div>
                <div class="td">(2)</div>
                <div class="td">(3)</div>
                <div class="td">(4)</div>
                <div class="td">(5)</div>
                <div class="td">(6)</div>
            </div>
            @php($ni = 0)
            @forelse($data46s as $data46)
                <div class="tr">
                    <div class="td center">{{ $ni += 1 }}</div>
                    <div class="td center">{{ $data46->nik }}</div>
                    <div class="td">
                        @if($data46->gelar_depan and $data46->gelar_belakang)
                            {{ $data46->gelar_depan }} {{ strtoupper($data46->nama) }}, {{ $data46->gelar_belakang }}
                        @elseif($data46->gelar_belakang)
                            {{ strtoupper($data46->nama) }}, {{ $data46->gelar_belakang }}
                        @elseif($data46->gelar_depan)
                            {{ $data46->gelar_depan }} {{ strtoupper($data46->nama) }}
                        @else
                            {{ strtoupper($data46->nama) }}
                        @endif
                    </div>
                    <div class="td center">{{ $data46->pendidikan->pendidikan }}</div>
                    <div class="td">{{ $data46->unit_kerja->unit_kerja }}</div>
                    <div class="td center">
                        @if($data46->pivot->keterangan_gampong)
                            {{ __('Perangkat Gampong') }}
                        @endif
                    </div>
                </div>
            @empty
                <div class="tr">
                    <div class="td"></div>
                    <div class="td"></div>
                    <div class="td"></div>
                    <div class="td center"><i>Data tidak ditemukan!</i></div>
                    <div class="td"></div>
                    <div class="td"></div>
                </div>
            @endforelse
        </div>
    @endif
    <table>
        <tr>
            <td></td>
            <td></td>
            <td class="jarak_tengah"></td>
            <td>Idi,</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">Pertimbangan Teknis Bupati Aceh Timur</td>
            <td></td>
            <td>Pj.</td>
            <td>KEPALA BADAN KEPEGAWAIAN DAN</td>
        </tr>
        <tr>
            <td>Nomor</td>
            <td>:</td>
            <td></td>
            <td></td>
            <td>PENGEMBANGAN SUMBER DAYA MANUSIA</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>:</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td class="ttd"></td>
            <td></td>
            <td></td>
            <td>TEUKU DIDI FARISHA, S.STP, M.AP</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Pembina</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>198412302004121001</td>
        </tr>
    </table>
</main>
</body>
</html>