<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/styles.css'])
    <title>Index Accueil</title>
</head>
<body>
    @include('layout.partials.header')

    {{-- Je prévois l'injection de quelque chose ici (optionnel !) --}}
    @yield('content')
    {{-- <h1>CONTACT</h1> --}}

    @include('layout.partials.footer')
</body>
</html>