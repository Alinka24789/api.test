<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='csrf-token' content="{{csrf_token()}}">

    <title>RESTful API</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
<!--    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>-->
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <!-- Application fonts -->
    <link href="/fonts/awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href='/css/polarbearfonts/flaticon.css' rel='stylesheet' type="text/css">
    
    <!-- Application styles-->
    <link href='/css/app.css' rel='stylesheet' type='text/css'>
    
</head>
<body id="app-layout">
    @if(Auth::guest())
    <div class='first-page'>
        <div class='content text-center'>
        @yield('content')
        </div>
    </div>
    @else
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">

                <!-- Branding Image -->
                <a class="navbar-brand main-logo logo-small" href="{{ url('/') }}">
                </a>
            </div>
            <!-- Right Side Of Navbar -->
            <ul class="main-menu menu-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Вход</a></li>
                @else
                <li>
                    <a href="{{ url('/logout') }}"><i class="flaticon-logout13"></i></a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="admin-page active">
         @yield('content')
    </div>
      
       <div class="admin-page no-active">
            
       </div>
    @endif

    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    <script src="/js/admin.js"></script>
</body>
</html>
