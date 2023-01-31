<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Programming</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts Files -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="{{ asset('chosen/chosen.min.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="p-12">
        @yield('content')
    </div>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    @yield('js')
</body>

</html>
