<!doctype html>
<html lang="de">
<head>

    <title>@yield('title')Scoop</title>

    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon_package/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon_package/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon_package/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon_package/site.webmanifest">
    <link rel="mask-icon" href="/images/favicon_package/safari-pinned-tab.svg" color="#fca298">
    <meta name="msapplication-TileColor" content="#fca298">
    <meta name="theme-color" content="#fca298">

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
{{--    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="/js/app.js"></script>

</head>
<body>

{{--<div class="spinner"></div>--}}

@include('partials.navbar')

<div class="content-wrapper main-wrapper">

    @include('partials.alerts')

    @yield('container')

</div>
@include('partials.footer')

</body>
</html>
