<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    {{-- <link rel="stylesheet" href="{{ mix('/css/app.css') }}"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css"> --}}
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div id="app">
        {{-- @include('layouts.navigation-sidebar') --}}
        <div class="wrapper">
            @yield('content')
        </div>
        {{-- <modal></modal> --}}
        <add-client-modal></add-client-modal>
        <add-project-modal></add-project-modal>
        <add-payment-modal></add-payment-modal>
    </div>
</body>
<script src="{{ mix('/js/app.js') }}"></script>
@yield('footer.scripts')
</html>
