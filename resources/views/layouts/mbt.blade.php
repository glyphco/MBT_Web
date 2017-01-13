<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title') - MyBoringTown.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Fira+Mono|Fira+Sans" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
  </style>
</head>
<body>


<!-- http://www.bootply.com/V46gEMiBa3 -->
<nav role="navigation" class="navbar navbar-default navbar-inverse">
  <div class="container">
    <div class="navbar-header navbar-left pull-left">
      <a href="/" class="navbar-brand">MyBoringTown</a>
    </div>
      @section('navlinks')
        @include('layouts.navlinks')
      @show
  </div>
</nav>




<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-10 text-left">
      @yield('content')
    </div>

  </div>
</div>

<footer class="container-fluid text-center">
  <p> &copy;2017 MyboringTown.com</p>
</footer>

</body>
</html>