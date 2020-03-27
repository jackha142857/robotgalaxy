<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Robot Galaxy</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom fonts -->
  <!--   <script src="https://kit.fontawesome.com/1be45fb696.js"></script> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles-->  
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @yield('header')
</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="{{ route('welcome') }}" style="@isset($active) {{ $active == 'welcome' ? 'color: Gold;' : '' }} @endisset">HOME</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('introduction') }}" style="@isset($active) {{ $active == 'introduction' ? 'color: Gold; text-decoration: overline wavy gold;' : '' }} @endisset" >Introduction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('features') }}" style="@isset($active) {{ $active == 'features' ? 'color: Gold; text-decoration: overline wavy gold;' : '' }} @endisset">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('contact') }}" style="@isset($active) {{ $active == 'contact' ? 'color: Gold; text-decoration: overline wavy gold;' : '' }} @endisset">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('thanks') }}" style="@isset($active) {{ $active == 'thanks' ? 'color: Gold; text-decoration: overline wavy gold;' : '' }} @endisset">Special Thanks!</a>
          </li>
          @guest
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="{{ route('login') }}" style="@isset($active) {{ $active == 'login' ? 'color: Gold; text-decoration: overline wavy gold;' : '' }} @endisset">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="{{ route('register') }}" style="@isset($active) {{ $active == 'register' ? 'color: Gold; text-decoration: overline wavy gold;' : '' }} @endisset">Register</a>
              </li>
          @else
              <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ route('logout') }}"
                        	onclick="event.preventDefault();
                        		   document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                    </form>
        	  </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
  <header class="masthead">    
  	@yield('content')	
  </header>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('jquery/jquery-3.4.1.js') }}"></script>
  <script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>
  <!--   <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script> -->
  <!-- Custom scripts -->
  <script src="{{ asset('js/app.min.js') }}"></script>
  <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
  @yield('footer')
</body>

</html>
