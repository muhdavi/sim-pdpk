<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="description" content="Sistem Informasi Pegawai Daerah dengan Perjanjian Kerja" />
        <meta name="keywords" content="sistem, pdpk, pegawai, kontrak"/>
        <meta name="author" content="@muhdavi"/>
        <meta property="og:title" content="SIM-PDPK"/>
        <meta property="og:url" content="https://pdpk.acehtimurkab.go.id"/>
        <meta property="og:description" content="Sistem Informasi Pegawai Daerah dengan Perjanjian Kerja" />
        <meta property="og:image" content="{{ asset('assets/images/SIM-PDPK-BIRU.png') }}"/>
        
        <title>SIM-PDPK</title>
        
        <link href="{{ asset('assets/images/favicon.png') }}" rel="shortcut icon">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
