<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    <header class="header layout-header">
        <div class="header__inner">
            <h1>Atte</h1>
            @yield('header-nav')

        </div>
    </header>
    @yield('content')
    <footer class="footer layout-footer">
        <p>Atte, inc.</p>
    </footer>
</body>

</html>