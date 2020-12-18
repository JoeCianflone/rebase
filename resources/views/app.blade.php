<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Rebase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons&Rubik:wght@300;400;500&family=Overpass:wght@700;800;900&display=swap" rel="stylesheet">

    <link href="{{ mix('/assets/css/app.css') }}" rel="stylesheet">

    @if (isset($withStripe) && $withStripe === true)
    <script src="//js.stripe.com/v3/"></script>
    @endif
    @routes

    <script src="{{ mix('/assets/js/app.js') }}" defer></script>
</head>

<body>
    @inertia
</body>

</html
