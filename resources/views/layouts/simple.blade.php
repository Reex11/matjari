<!doctype html dir="rtl">
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>نظام بقالتي  @yield("title")</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Tajawal:100,300,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        
        <link rel="stylesheet" href="/css/app.css">

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
    <body>
        <div class="navbar nav-links">
            <span style="font-size: 30px"> نظام بقالتي </span>
            <a href="/#">الرئيسية</a>
            <a href="/shifts">الورديات</a>
            <a href="/employees">الموظفين</a>
        </div>
        <div class="content">
            <div class="row mb-5 mr-2">

                    <h1>@yield('page-title')</h1>
                    <div class="mr-5 my-auto">
                        @yield('page-nav')
                    </div>

            </div>
            @yield('content')
        </div>
    </body>
</html>
