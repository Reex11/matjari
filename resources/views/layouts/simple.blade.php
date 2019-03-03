<!doctype html dir="rtl">
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>نظام بقالتي  @yield("title")</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Tajawal:300,500,700" rel="stylesheet" type="text/css">
        <!-- fontawesome icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">

        <!-- Js -->
        <script src="/js/app.js"></script>



        <style>
            .full-height {
                height: 100vh;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 20px;
                top: 18px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body id="#app">
        <div class="navbar nav-links d-print-none">
            <span style="font-size: 30px"> نظام بقالتي </span>
            <a href="/#">الرئيسية</a>
            <a href="/shifts">الورديات</a>
            <a href="/employees">الموظفين</a>
        </div>
        <div class="content">
            <div class="row mb-5 mx-3 d-print-none">

                    <h1 class="h2">@yield('page-title')</h1>
                    <div class="mr-5 my-auto ml-auto">
                        @yield('page-nav')
                    </div>
                    <div class="my-auto">
                        @yield('left-page-nav')
                    </div>

            </div>
            @yield('content')
        </div>
        <script type="text/javascript">
            @yield('custom-js')
        </script>


    </body>
</html>
