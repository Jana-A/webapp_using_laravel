<!doctype html>
<html>

  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>

<style>

 .navbar {
  /*background-color: #DCDCDC;
  margin-top: 10px;*/
 }

 body {
  margin:0;
  background-color: #E6E6FA;
 }

/* footer {
   position:absolute;
   bottom:0;
   width:100%;
   background:#6cf;
}*/

</style>

  </head>

  <body>

    <div class="container">

      <!-- navbar section -->
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">Home</a>
          </div>

          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="{{ url('about') }}">About</a></li>
              <li><a href="{{ url('events') }}">Events</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('browse') }}">Browse Services</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Service Stats</a></li>
                </ul>
              </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
@if(Session()->has('user_agent'))
<?php
echo '<li class="active"><a href="http://localhost/blog/profile">My Profile</a></li>';
echo '<li><a href="http://localhost/blog/logout">Logout</a></li>';
?>
@else 
<?php
echo '<li><a href="http://localhost/blog/register">Register</a></li>';
echo '<li><a href="http://localhost/blog/login">Login</a></li>';
?>
@endif


            </ul>
          </div>

        </div>
      </nav>
    </div>

        <div>
            @yield('content')
        </div>

  </body>

</html>