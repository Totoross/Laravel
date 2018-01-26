<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title', '主页') - Laravel 学习之路</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
            @include('layouts.header')

        <div class="container">
            <div class="col-md-offset-1 col-md-10">
                @yield('content')
                @include('layouts.footer')
            </div>
        </div>
    </body>
</html>