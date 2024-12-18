<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TMDB Test</title>
</head>
<body>

<div class="container">

    @include('_partials.header')

    @if(Session::has('message'))
        <div id="message" style="position: relative;" class="alert alert-info mt-5">
            <a class="close" data-dismiss="alert">×</a>
            {{ Session::get('message') }}
        </div>
    @endif

    @yield('content')

    @include('_partials.footer')

</div>

</body>
</html>
