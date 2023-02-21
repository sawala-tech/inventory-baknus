<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/png">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}">

</head>

<body class='bg-gray'>
    @include('components.header.app')
    <div class="container-fluid">
        <section class="section-content">
            <div class="row">
                @include('components.sidebar.app')
                <main class="col-lg-10 mx-0 p-4">
                    @yield('content')
                </main>
            </div>
        </section>
    </div>
</body>

<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

</html>
