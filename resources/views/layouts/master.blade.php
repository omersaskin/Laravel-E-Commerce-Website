<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'E-Ticaret')</title>
    @include('layouts.partials.head')
    @yield('head')
</head>

<body id="commerce">
    @include('layouts.partials.navbar')
    @yield('content')
    @include('layouts.partials.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    @yield('footer')
</body>

</html>