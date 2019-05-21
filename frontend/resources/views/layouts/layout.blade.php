<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>


    <!-- Bootstrap core CSS -->
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <!-- <link href="pricing.css" rel="stylesheet"> -->
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<!--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" /> -->
    @yield('custom_css')


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Scripts -->
    
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.0/p5.min.js" crossorigin="anonymous"></script> -->
        
  </head>

  <body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">JSJ Cinema</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        @if(session()->has('user'))
          @if(session('user')->isAdmin == true)
          <!-- Admin nav -->
            <a class="p-2 text-dark" href="{{ route('transaction.index') }}">TRANSACTIONS</a>
            <a class="p-2 text-dark" href="{{ route('movies.index') }}">MOVIES</a>
            <a class="p-2 text-dark" href="{{ route('theatres.index') }}">THEATRES</a>
            <a class="p-2 text-dark" href="{{ route('users.index') }}">USERS</a>
          @else
          <!-- Users nav -->
            <a class="p-2 text-dark" href="{{ route('home') }}">HOME</a>
            <a class="p-2 text-dark" href="{{ route('home') }}">OUR CINEMA</a>
            <a class="p-2 text-dark" href="{{ route('home') }}">ABOUT US</a>
          @endif
        @else
          <!-- Guest navs -->
            <a class="p-2 text-dark" href="{{ route('home') }}">HOME</a>
            <a class="p-2 text-dark" href="#">OUR CINEMA</a>
            <a class="p-2 text-dark" href="#">ABOUT US</a>            
        @endif       
      </nav>

        @if(session()->has('user'))
          @if(session('user')->isAdmin == true)
            <!-- Admin nav -->
            <a class="btn btn-outline-primary" href="{{ route('logout') }}">Logout</a>    
          @else
            <!-- Users nav -->
            <a class="btn btn-outline-primary mr-1" href="{{ route('myaccount') }}">My Account</a>
            <a class="btn btn-outline-primary" href="{{ route('logout') }}">Logout</a>
          @endif
        @else
        <a class="btn btn-outline-primary mr-2" href="{{ route('login') }}">Login</a>
        <a class="btn btn-outline-primary mr-2" href="{{ route('users.create') }}">Register</a>
        @endif
    </div>

<div class="content">
      <div class="content-inside">
        <div class="container-fluid">
           @yield('content')
        </div>
        @yield('custom_script')
       </div>
    </div>
    <footer class="footer mt-1">FOOTER HERE!</footer>
  </body>
</html>











