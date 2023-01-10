<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1B1E32" />
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('asset/img/media.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('asset/img/media.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('asset/img/media.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('asset/img/media.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href=@yield('css')>
</head>

<body>
    @yield('layouts')
</body>
</html>
