<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Rebase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="//fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="//fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ mix('/assets/css/app.css') }}" rel="stylesheet">

    <script src="//js.stripe.com/v3/" defer></script>
    <script src="{{ mix('/assets/js/app.js') }}" defer></script>
</head>

<body>
    @inertia
</body>

</html>
