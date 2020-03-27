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
  <link href="{{ asset('css/shop-homepage.css') }}" rel="stylesheet">
  <!-- Datatable -->
  <link href="{{ asset('datatables/datatables.min.css') }}" rel="stylesheet">
  @yield('header')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    	<div class="container">
            <a class="navbar-brand" href="/">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">                  
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="color: Pink;">Login to use full features!</a>
                    </li>
                    <li class="nav-item @isset($active) {{ $active == 'source' ? 'active' : '' }} @endisset">
                    <a class="nav-link" href="/source">Robots/AIs
                    </a>
                    </li> 
                    <li class="nav-item @isset($active) {{ $active == 'upload' ? 'active' : '' }} @endisset">
                        <a class="nav-link" href="{{ route('upload') }}">{{ __('Upload') }}</a>
                    </li>
                    <li class="nav-item @isset($active) {{ $active == 'login' ? 'active' : '' }} @endisset">
                    	<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item @isset($active) {{ $active == 'register' ? 'active' : '' }} @endisset">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @else           	                    	
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile', Auth::user()->id) }}" style="color: Pink;">Welcome {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item @isset($active) {{ $active == 'source' ? 'active' : '' }} @endisset">
                    <a class="nav-link" href="/source">Robots/AIs
                    </a>
                    </li> 
                    <li class="nav-item @isset($active) {{ $active == 'upload' ? 'active' : '' }} @endisset">
                        <a class="nav-link" href="{{ route('upload') }}">{{ __('Upload') }}</a>
                    </li>
                    <li class="nav-item @isset($active) {{ $active == 'shared' ? 'active' : '' }} @endisset">
                        <a class="nav-link" href="{{ route('shared') }}">{{ __('My shared') }}</a>
                    </li>
                    <li class="nav-item @isset($active) {{ $active == 'saved' ? 'active' : '' }} @endisset">
                        <a class="nav-link" href="{{ route('saved') }}">{{ __('Saved List') }}</a>
                    </li>
                    <li class="nav-item @isset($active) {{ $active == 'profile' ? 'active' : '' }} @endisset">
                        <a class="nav-link" href="{{ route('profile', Auth::user()->id) }}">{{ __('Profile') }}</a>
                    </li>
                    <li class="nav-item @isset($active) {{ $active == 'statistic' ? 'active' : '' }} @endisset">
                        <a class="nav-link" href="{{ route('statistic') }}">{{ __('Statistic') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
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
    
    <!-- Page Content -->
    <div class="container">    
    	@yield('content')    
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5">
        <div class="container">
        	<p class="m-0 text-center">Copyright &copy; Robot Galaxy 2019</p>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('jquery/jquery-3.4.1.js') }}"></script>
  	<script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- Datatable -->
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
  	<script src="{{ asset('datatables/cardtransfer.js') }}"></script> 
  	
  	
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
