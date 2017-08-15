@extends('layouts.app')
@section('content')
<style type="text/css">
.well {
	background-color: #e7594b;/*7f7fe6*/
	color: #FFFFFF;
}
</style>
<div class="col-md-8 col-md-offset-2">
  {!! Form::open(['action'=>'UserSetup@register_ctrl', 'files' => true, 'id' => 'registration_form', 'onsubmit' => 'return validate_and_register(this);']) !!}
    <h3 class="well well-sm"><em>Personal</em></h3>
    <div class="row">
      <div class="form-group col-xs-4">
        {{ Form::label('First Name') }}
        {{ Form::text('firstname', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'firstname', 'name' => 'firstname', 'placeholder' => 'firstname')) }}
      </div>
    </div>
    <div class="row">
      <div class="form-group col-xs-4">
        {{ Form::label('Last Name') }}
        {{ Form::text('lastname', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'lastname', 'name' => 'lastname', 'placeholder' => 'lastname')) }}
      </div>
    </div>
    <div class="row">
      <div class="form-group col-xs-4">
        {{ Form::label('Country') }}<br />
{{ Form::select('country', [
   'null' => '',
   'belgium' => 'Belgium',
   'sweden' => 'Sweden',
   'china' => 'China',
   'denmark' => 'Denmark',
   'canada' => 'Canada',
   'united kingdom' => 'United Kingdom',
   'united states' => 'United States',
   'germany' => 'Germany'], null, ['class' => 'form-control', 'placeholder' => 'select']) }}
      </div>
    </div>
    <div class="row">
      <div class="form-group col-xs-4">
        {{ Form::label('City') }}
        {{ Form::text('city', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'city', 'name' => 'city', 'placeholder' => 'city')) }}
      </div>
    </div>    

    <h3 class="well well-sm"><em>Occupation</em></h3>
    <div class="row">
      <div class="form-group col-xs-4">
        {{ Form::label('Organisation') }}
        {{ Form::text('organisation', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'organisation', 'name' => 'organisation', 'placeholder' => 'organisation')) }}
      </div>
    </div>
    <div class="row">
      <div class="form-group col-xs-4">
        {{ Form::label('Occupation') }}
        {{ Form::text('occupation', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'occupation', 'name' => 'occupation', 'placeholder' => 'occupation')) }}
      </div>
    </div>    

    <h3 class="well well-sm"><em>User</em></h3>
    <div class="row">
      <div class="form-group col-xs-4">
        {{ Form::label('Username') }}
        {{ Form::text('username', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'username', 'name' => 'username', 'placeholder' => 'username')) }}
        <div id="username_alert" style="display:none;color:red;">Enter a username!</div>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-xs-4">
        {{ Form::label('Password') }}
        <br />
        {{ Form::password('password', array('type' => 'password', 'class' => 'form-control', 'id' => 'password', 'name' => 'password', 'placeholder' => 'password')) }}
        <div id="password_alert" style="display:none;color:red;">Enter a password!</div>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-xs-4">
        {{ Form::label('Email') }}
        {{ Form::text('email', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'email', 'name' => 'email', 'placeholder' => 'email')) }}
        <div id="email_alert" style="display:none;color:red;">Enter an email!</div>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-xs-4">
        {!! Form::label('Profile Image') !!}
        {!! Form::file('image') !!}
      </div>
    </div>
    <div>
      <button type="submit" class="btn btn-inverse"/>Register</button>
    </div>

  {!! Form::close() !!}
</div>

        <script type="text/javascript">
            // Form validation before submission to server
            function validate_and_register() {
                var username = document.getElementById("username").value;
                var password = document.getElementById("password").value;
                var email = document.getElementById("email").value;

                if (username == "" || username == " ") {
                    document.getElementById("username_alert").style.display = "block";
                    document.getElementById("password_alert").style.display = "none";
                    document.getElementById("email_alert").style.display = "none";
                    return false;
                }
                if (password == "" || password == " ") {
                    document.getElementById("password_alert").style.display = "block";
                    document.getElementById("username_alert").style.display = "none";
                    document.getElementById("email_alert").style.display = "none";
                    return false;
                }
                if (email == "" || email == " ") {
                    document.getElementById("email_alert").style.display = "block";
                    document.getElementById("username_alert").style.display = "none";
                    document.getElementById("password_alert").style.display = "none";
                    return false;
                }
                  else {
                    document.getElementById("password_alert").style.display = "none";
                    document.getElementById("username_alert").style.display = "none";
                    document.getElementById("email_alert").style.display = "none";
                    return true;
                }
            }
        </script>

@endsection