@extends('layouts.app')
@section('content')
<style>

 #carousel {
  background-color: #e7594b;/*e74c3c*/
 }
 .carousel .item {
    width: 100%;
    height: 500px;
}

.jumbotron {
  margin-right:15%;
  margin-left:15%;
  background-color: #e7594b;
  color:#E6E6FA;
}

.container a {
    text-decoration: none;
}

}

</style>

    <div class="container">
      <!-- carousel section -->
      <div id="carousel" class="carousel slide" data-ride="carousel">
          <!-- Menu -->
          <ol class="carousel-indicators">
              <li data-target="#carousel" data-slide-to="0" class="active"></li>
              <li data-target="#carousel" data-slide-to="1"></li>
              <!--<li data-target="#carousel" data-slide-to="2"></li>-->
          </ol>
    
          <!-- Items -->
          <div class="carousel-inner">
            <div class="item active">
              <div><a href="">
                <div class="jumbotron">
                  <h1 class="display-3">Community Stories</h1>
                  <p class="lead">Find about efforts and success stories of the volunteers in the community.</p>
                  <hr class="my-4">
                  <p>Static html content of past successful stories related to the foundation. Not updated regularly ... more</p>
                </div></a>
              </div>
            </div>
            <div class="item">
              <div><a href="">
                <div class="jumbotron">
                  <h1 class="display-3">What's new</h1>
                  <p class="lead">Information about global petitions and movements in local communitites.</p>
                  <hr class="my-4">
                  <p>Articles posted by users. Updated regularly ... more</p>
                </div></a>
              </div>
            </div>
<!--
            <div class="item">
              <div>
                <div class="jumbotron">
                  <h1 class="display-3">Social Media</h1>
                  <p class="lead">Staying connected.</p>
                  <hr class="my-4">
                  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                  <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                  </p>
                </div>
              </div>
            </div>
-->
          </div>  

        <a href="#carousel" class="left carousel-control" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a href="#carousel" class="right carousel-control" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>
    </div>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">    
    <hr />
        <div class="text-center center-block">
              <a href="https://www.facebook.com"><i class="fa fa-facebook-square fa-3x social"></i></a>
              <a href="https://twitter.com"><i class="fa fa-twitter-square fa-3x social"></i></a>
        </div>
    <hr />
</div>

@endsection

