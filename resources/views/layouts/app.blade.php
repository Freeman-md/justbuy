<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'JustBuy') }}</title>
        <link rel="shortcut icon" href="https://img.icons8.com/pastel-glyph/40/000000/shopping-bags--v1.png" type="image/png">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap">

        {{-- Local Fonts --}}
        <link rel="stylesheet" href="{{ asset('assets/fonts/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fonts/css/brands.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fonts/css/fontawesome.css') }}">

        {{-- Owl Carousel --}}
        <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.css') }}" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}"> 

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen">
            @include('includes.navigation')

            <!-- Page Heading -->
            

            <!-- Page Content -->
            <main class="z-1">
                {{ $slot }}
            </main>

            @livewire('product')

            @include('includes.footer')
        </div>

        @stack('modals')

        @livewireScripts

        {{-- CDN's --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=&v=weekly"
        async></script>

        {{-- Toastr --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
        {!! Toastr::message() !!}

        <script>
            $(function() {
                    @if(Session::has('success'))
                    toastr.success("{{session('success')}}")
                    @elseif(Session::has('error'))
                    toastr.error("{{session('error')}}")
                    @elseif(Session::has('warning'))
                    toastr.warning("{{session('warning')}}")
                    @elseif(Session::has('info'))
                    toastr.info("{{session('info')}}")
                    @endif
            })
        </script>

        {{-- Owl Carousel --}}
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        
        <!-- Scripts -->
        <script src="{{ asset('assets/js/app.js') }}" defer></script>
        <script src="{{ asset('assets/js/custom.js') }}" defer></script>
    </body>
</html>
