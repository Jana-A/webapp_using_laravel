@extends('layouts.app')
@section('content')

<div class="container" id="profile_form">
      <div class="row">

<div class="col-md-8 col-md-offset-2">
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{ $user }} : {{ $firstname }} {{ $lastname }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img src="{{$image_src}}" class="img-square img-responsive"> </div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Email:</td>
                        <td>{{ $email }}</td>
                      </tr>
                      <tr>
                        <td>City:</td>
                        <td>{{ $city }}</td>
                      </tr>
                      <tr>
                        <td>Country:</td>
                        <td>{{ $country }}</td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Organisation:</td>
                        <td>{{ $organisation }}</td>
                      </tr>
                        <tr>
                        <td>Occupation:</td>
                        <td>{{ $occupation }}</td>
                      </tr>
                        <tr>
                        <td>Ratings:</td>
                        <td>{!! $ratings !!}</td>
                      </tr>
                        </tr>
                        <tr>
                        <td></td>
                        <td></td>
                      </tr>
                      </tr>
                     
                    </tbody>
                  </table>
                  @if(Session()->get('user_agent') == $user)
                  <button class="btn btn-primary" onclick="show_edit_form()">Edit Profile</button>
                  @else
                  <a href="{{ URL::to('rate_user' . '?user=' . $user . '&referee=' . Session()->get('user_agent') . '&score=' . '1') }}" style="margin:15px;">Like</a>
                  <a href="{{ URL::to('rate_user' . '?user=' . $user . '&referee=' . Session()->get('user_agent') . '&score=' . '0') }}" style="margin:15px;">Dislike</a>
                  <form method="post" action="mailto:bla@email.com" >
                  <input style="margin:10px;" type="submit" class="btn btn-danger" value="Report this user" />
                  </form>
                  @endif
                </div>
              </div>
            </div>
                 <div class="panel-footer" style="height:40px;">
                    </div>
            
          </div>
        </div>
      </div>
    </div>

@if(Session()->get('user_agent') == $user)

<div id="edit_form" class="container" style="display:none;">
      <div class="row">

<div class="col-md-8 col-md-offset-2">
   {!! Form::open(['action'=>'UserProfile@edit_profile', 'files' => true]) !!}
          <div class="panel panel-info">
            <div class="panel-heading col-xs-3">
              <h3 class="panel-title">{{ Form::text('firstname', $firstname, array('type' => 'text', 'class' => 'form-control', 'id' => 'firstname', 'name' => 'firstname', 'placeholder' => 'firstname')) }}</h3>
            </div>
            <div class="panel-heading col-xs-3">
              <h3 class="panel-title">{{ Form::text('lastname', $lastname, array('type' => 'text', 'class' => 'form-control', 'id' => 'lastname', 'name' => 'lastname', 'placeholder' => 'lastname')) }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
      <div class="form-group col-xs-4">
        {!! Form::label('Profile Image') !!}
        {!! Form::file('image') !!}
      </div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Email:</td>
                        <td>{{ Form::text('email', $email, array('type' => 'text', 'class' => 'form-control', 'id' => 'email', 'name' => 'email', 'placeholder' => 'email')) }}</td>
                      </tr>
                      <tr>
                        <td>City:</td>
                        <td>{{ Form::text('city', $city, array('type' => 'text', 'class' => 'form-control', 'id' => 'city', 'name' => 'city', 'placeholder' => 'city')) }}</td>
                      </tr>
                      <tr>
                        <td>Country:</td>
                        <td>{{ Form::text('country', $country, array('type' => 'text', 'class' => 'form-control', 'id' => 'country', 'name' => 'country', 'placeholder' => 'country')) }}</td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Organisation:</td>
                        <td>{{ Form::text('organisation', $organisation, array('type' => 'text', 'class' => 'form-control', 'id' => 'organisation', 'name' => 'organisation', 'placeholder' => 'organisation')) }}</td>
                      </tr>
                        <tr>
                        <td>Occupation:</td>
                        <td>{{ Form::text('occupation', $occupation, array('type' => 'text', 'class' => 'form-control', 'id' => 'occupation', 'name' => 'occupation', 'placeholder' => 'occupation')) }}</td>
                      </tr>
                        </tr>
                        <tr>
                        <td></td>
                        <td></td>
                      </tr>
                      </tr>
                     
                    </tbody>
                  </table>
                  
                  <button type="submit" class="btn btn-primary">Save</button>
                  {!! Form::close() !!}
                  <button onclick="cancel();return false;" class="btn btn-primary">Cancel</button>
                </div>
              </div>
            </div>
                 <div class="panel-footer" style="height:40px;">
            </div>
            
          </div>

        </div>
      </div>
    </div>


<script type="text/javascript">

function show_edit_form() {
	document.getElementById("edit_form").style.display = "block";
	document.getElementById("profile_form").style.display = "none";
};

function cancel() {
	document.getElementById("edit_form").style.display = "none";
	document.getElementById("profile_form").style.display = "block";
};

</script>

@endif

@endsection