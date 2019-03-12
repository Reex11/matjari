<!doctype html dir="rtl">
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>@yield("title") | نظام متجري </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Tajawal:300,500,700" rel="stylesheet" type="text/css">
        <!-- fontawesome icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}">

        <!-- Js -->
        <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>

        <script src="/js/app.js"></script>

        <link rel="manifest" href="{{ asset('/js/manifest.json') }}">


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
        <nav class="navbar matjari-nav navbar-expand-lg navbar-light bg-white">
          <a class="navbar-brand font-weight-lighter" style="font-size: 30px" href="#"> نظام  متجري  </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="/">الرئيسية</a>
              </li>
              {{-- Tables --}}
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTablesLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  الورديات
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownTablesLink" dir="rtl">
                    {{-- <a class="dropdown-item-text">الجداول</a> --}}
                    <a class="dropdown-item" href="/shifts/1"><i class="fas fa-table fa-fw fa-sm ml-2"></i>جدول الكاشير</a>
                    <a class="dropdown-item disabled" href="#"><i class="fas fa-plus-square fa-fw fa-sm ml-2"></i>إضافة جدول جديد (قريبا)</a>
                </div>
              </li>
              {{-- Employees | Salaries | Rewards --}}
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownEmployeesLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  الموظفون
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownEmployeesLink" dir="rtl">
                  <a class="dropdown-item" href="/employees/create"><i class="fas fa-user-plus fa-fw fa-sm ml-2"></i>إضافة موظف</a>
                  <a class="dropdown-item" href="/employees"><i class="fas fa-users fa-fw fa-sm ml-2"></i>قائمة الموظفين</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownEmployeesLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  الرواتب والمكافآت
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownEmployeesLink" dir="rtl">
                  <a class="dropdown-item-text">المكافآت والخصم</a>
                  <a class="dropdown-item" href="/rewards/create"><i class="fas fa-plus-square fa-fw fa-sm ml-2"></i>إضافة مكافأة/خصم</a>
                  <a class="dropdown-item" href="/rewards"><i class="fas fa-list fa-fw fa-sm ml-2"></i>قائمة المكافآت والخصم</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item-text">الرواتب</a>
                  <a class="dropdown-item" href="/salaries"><i class="fas fa-file-invoice-dollar fa-fw fa-sm ml-2"></i>الرواتب</a>
                </div>
              </li>
             {{--  <li class="nav-item">
                <a class="nav-link" href="/reminders">التذكيرات</a>
              </li> --}}
              
            </ul>
            <span class="navbar-text">
              نسخة تجريبية - v{{ config('app.ver') }} @if ( App::environment() == 'local' ) <i class="fas fa-server text-success"></i> @endif
            </span>
          </div>
        </nav>
        <div class="content">
            @if (session('msgs') OR isset($msgs))
              <?php if (session('msgs')) $msgs = session('msgs') ?>
                @foreach ($msgs as $msg)
                    @foreach ($msg as $type => $text)
                    <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                        {{ $text }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endforeach
                @endforeach
            @endif
            <div class="row mb-5 mx-3 d-print-none">

                    <h1 class="h2">@yield('page-title')</h1>
                    <div class="mr-md-5 mx-auto my-auto ml-md-auto">
                        @yield('page-nav')
                    </div>
                    <div class="mx-auto ml-md-1">
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
