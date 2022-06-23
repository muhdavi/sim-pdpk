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
        
        <title>{{ config('app.name', 'SIM-PDPK') }}</title>
        
        <link href="{{ asset('assets/images/favicon.png') }}" rel="shortcut icon">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- highcharts -->
        <script src="https://code.highcharts.com/highcharts.js"></script>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- jQuery UI -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        <!-- Select2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

        <style type="text/css">
            .ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
                width: 50% !important;
            }
        </style>
        <script>
            $( function() {
                $( "#tanggal_lahir" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    maxDate: '-18Y',
                });
                $( "#tanggal_lulus" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    maxDate: '+0d',
                });
                $( "#tmt" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    maxDate: '+0d',
                });
                $( "#tanggal_pertek" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    maxDate: '+0d',
                });
            } );
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="relative bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            
            <footer class="flex flex-wrap items-center justify-between p-3 m-auto bg-white shadow">
                <div class="container mx-auto flex flex-col flex-wrap items-center justify-between">
                    <ul class="flex mx-auto text-center">
                      <li class="p-2 cursor-pointer hover:underline">Panduan</li>
                      <li class="p-2 cursor-pointer hover:underline">Ketentuan</li>
                      <li class="p-2 cursor-pointer hover:underline">Bantuan</li>
                    </ul>
                    <ul class="flex mx-auto text-center">
                      <li class="p-2 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" class="fill-current" width="24" height="24" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg></li>
                      <li class="p-2 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" class="fill-current" width="24" height="24" viewBox="0 0 24 24"><path d="M21.231 0h-18.462c-1.529 0-2.769 1.24-2.769 2.769v18.46c0 1.531 1.24 2.771 2.769 2.771h18.463c1.529 0 2.768-1.24 2.768-2.771v-18.46c0-1.529-1.239-2.769-2.769-2.769zm-9.231 7.385c2.549 0 4.616 2.065 4.616 4.615 0 2.549-2.067 4.616-4.616 4.616s-4.615-2.068-4.615-4.616c0-2.55 2.066-4.615 4.615-4.615zm9 12.693c0 .509-.413.922-.924.922h-16.152c-.511 0-.924-.413-.924-.922v-10.078h1.897c-.088.315-.153.64-.2.971-.05.337-.081.679-.081 1.029 0 4.079 3.306 7.385 7.384 7.385s7.384-3.306 7.384-7.385c0-.35-.031-.692-.081-1.028-.047-.331-.112-.656-.2-.971h1.897v10.077zm0-13.98c0 .509-.413.923-.924.923h-2.174c-.511 0-.923-.414-.923-.923v-2.175c0-.51.412-.923.923-.923h2.174c.511 0 .924.413.924.923v2.175z" fillRule="evenodd" clipRule="evenodd"/></svg></li>
                      <li class="p-2 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" class="fill-current" width="24" height="24" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></li>
                    </ul>
                    <div class="flex mx-auto text-center">
                        {{ Date('Y') }} &copy; BKPSDM Aceh Timur 
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
