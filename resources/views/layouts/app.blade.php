<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--
    <title>Hint System </title>
--}}
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    {{--
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
          margin-right: 6px;
        }
    </style>
    --}}
    <link href="{{ url('app.css') }}" rel="stylesheet">
</head>
<body id="app-layout">
  <nav class="navbar navbar-default" style="opacity: 0"></nav>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="translate">Hint System</span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        {{--<li><a href="{{ url('/login') }}" class="translate">Login</a></li>
                        <li><a href="{{ url('/register') }}" class="translate">Register</a></li>--}}
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                              
                              {{--<li><a href="{{ url('/password/nomail/reset') }}">
                                <i class="fa fa-btn fa-refresh"></i>
                                <span class="translate">Password</span>
                                </a>
                              </li>--}}

                              {{--
                              <li>
                                <a href="{{ url('/accounts') }}"> --}}
                                  {{--<i class="fa fa-btn fa-euro"></i>--}}
                                  {{-- <i class="fa fa-btn fa-dollar"></i>
                                  <span class="translate">Accounts/Billing</span>
                                </a>
                              </li> --}}
                              
                              <li class="logout">
                                {{--
                                <a href="{{ url('/logout') }}" id="logout"><i class="fa fa-btn fa-sign-out"></i><span class="translate">Logout</span></a>
                               --}}
                               {{-- <div class="logout"></div>--}}
                              </li>
                              
                          </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    {{--
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <script src="https://unpkg.com/react@15/dist/react.js"></script>
    <script src="https://unpkg.com/react-dom@15/dist/react-dom.js"></script>
  --}}
    {{-- <script src="bundle.js"></script> --}}
    <script>window.token = '{{ csrf_token() }}'</script>
    <script>sessionStorage.token = '{{ csrf_token() }}'</script>
    <script src="{{ url('/bundle.js') }}"></script>
</body>
</html>
