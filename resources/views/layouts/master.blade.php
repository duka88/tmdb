<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TMDB Test</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
     @endif
     <script src="https://kit.fontawesome.com/bb825573ac.js" crossorigin="anonymous"></script>
</head>
<body>

<div >

    @include('_partials.header')
   
    @if(Session::has('message'))
        <div id="message" style="position: relative;" class="alert alert-info mt-5">
            <a class="close" data-dismiss="alert">×</a>
            {{ Session::get('message') }}
        </div>
    @endif
    <main class=main>
       @yield('content')
    </main>

 
    @include('_partials.footer')

</div>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/js/app.js'])
     @endif
   
</body>
</html>
