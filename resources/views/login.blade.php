@extends('layouts.app')
@section('content')
<style type="text/css">
.well {
    background-color: #e7594b;/*7f7fe6*/
    color: #FFFFFF;
}
</style>

<?php
if (isset($_SERVER['HTTP_REFERER'])) {
$prev_url = $_SERVER['HTTP_REFERER'];
Session::put('prev_url', $prev_url);
}
?>
<div class="col-md-8 col-md-offset-2">
  {!! Form::open(['action'=>'UserSetup@login_ctrl', 'name' => 'login_form', 'id' => 'login_form', 'onsubmit' => 'return validate_and_submit(this);']) !!}
    <h3 class="well well-sm"><em>Login</em></h3>
    <div class="row">
      <div class="form-group col-xs-4">
        {{ Form::label('Username') }}
        {{ Form::text('login_username', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'login_username', 'name' => 'login_username', 'placeholder' => 'username')) }}
        <div id="username_alert" style="display:none;color:red;">Enter a username!</div>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-xs-4">
        {{ Form::label('Password') }}
        {{ Form::password('login_password', array('type' => 'password', 'class' => 'form-control', 'id' => 'login_password', 'name' => 'login_password', 'placeholder' => 'password')) }}
        <div id="password_alert" style="display:none;color:red;">Enter a password!</div>
      </div>
    </div>
    <div>
    <button type="submit" name="logme" class="btn btn-inverse"/>Login</button>
  {!! Form::close() !!}
    </div>

</div>
        <script type="text/javascript">
            // Form validation before submission to server
            function validate_and_submit() {
                var username = document.getElementById("login_username").value;
                var password = document.getElementById("login_password").value;

                if (username == "" || username == " ") {
                    document.getElementById("username_alert").style.display = "block";
                    document.getElementById("password_alert").style.display = "none";
                    return false;
                }
                if (password == "" || password == " ") {
                    document.getElementById("password_alert").style.display = "block";
                    document.getElementById("username_alert").style.display = "none";
                    return false;
                } else {
                    document.getElementById("password_alert").style.display = "none";
                    document.getElementById("username_alert").style.display = "none";
                    return true;
                }
            }
        </script>

@endsection
