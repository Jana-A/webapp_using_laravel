@extends('layouts.app')
@section('content')

<style type="text/css">
.message-bubble 
{
    padding: 10px 0px 10px 0px;
}

.message-bubble:nth-child(even) { background-color: #F5F5F5; }

.message-bubble > *
{
    padding-left: 10px;    
}

.panel-body { padding: 0px; }

.panel-heading { background-color: #e7594b !important; color: white !important; }
</style>

<div class="container">
{{ Form::open(['action' => 'ServiceOperations@post_comment', 'onsubmit' => 'return text_checker(this);']) }}
      {{ Form::hidden('invisible', app('request')->input('id')) }}
      {{ Form::text("msg", null, array("type" => "text", "class" => "form-control", "id" => "msg", "name" => "msg", "placeholder" => "Type your message ...")) }}
        <button class="btn btn-default" type="submit">Send</button>
        <div id="comment_alert" style="display:none;color:red;">Enter a valid comment!</div>
{!! Form::close() !!}

{!! $content !!}

</div>

        <script type="text/javascript">
            // Form validation before submission to server
            function text_checker() {
                var comment_text = document.getElementById("msg").value;

                if (comment_text == "" || comment_text == " ") {
                    document.getElementById("comment_alert").style.display = "block";
                    return false;
                }
                  else {
                    document.getElementById("comment_alert").style.display = "none";
                    return true;
                }
            }
        </script>

@endsection