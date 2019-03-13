<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>نظام متجري</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Tajawal:200,400,700" rel="stylesheet" type="text/css">
        <!-- fontawesome icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">

        <!-- Js -->
        <script src="/js/app.js"></script>
        <link rel="manifest" href="/js/manifest.json">


        <!-- Styles -->
        <style>
            html, body {
                direction: rtl;
                background-color: #fff;
                color: #636b6f;
                font-family: 'Tajawal', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 20px;
                font-weight: 600;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">

                <div class="title">
                    متجري
                </div>
                <p class="lead text-center">
                    نظام الخدمات المساعدة لإدارة المتجر
                </p>
                <div class="{{-- links --}}">

                    <a class="btn btn-success btn-lg mb-2" href="/shifts">الورديات</a>
                    <a class="btn btn-success btn-lg mb-2" href="/employees">الموظفين</a>
                    <span>
                        <a class="btn btn-success btn-lg mb-2" href="/salaries">الرواتب والمكافآت</a>
                    </span>
                    <span>
                        <a class="btn btn-success btn-lg mb-2 disabled" href="#">المنبهات (قريبا)</a>
                    </span>

                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    </body>
</html>
