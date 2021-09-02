<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>


    @yield('style')


</head>
<body>


    @include('includes.header')


    <main>


        <div class="center_container">
            @yield('main.center_contents')
        </div>


        <div class="side_container"></div>


    </main>


    @include('includes.footer')

    @yield('script')


</body>
</html>
