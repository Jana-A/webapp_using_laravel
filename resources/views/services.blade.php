@extends('layouts.app')
@section('content')
<style>
#demo {
}
</style>

@if(Session()->has('user_agent'))
@include('add_service')
@else
<div class="container">
<button id="my_btn" type="button" style="float:right;margin-right:10px;width:20%;" class="btn btn-info btn-lg disabled">Add A Service <span class="glyphicon glyphicon-plus-sign"></span></button>
<div id="btn_msg_div" style="color:red;float:right;display:none;padding:3px;">
Login to add a service!
</div>
</div>
@endif
<div class="container">
<button type="button" style="float:right;margin-right:10px;margin-top:5px;width:20%;" class="btn btn-info btn-lg" data-toggle="collapse" data-target="#demo">Search Options <span class="glyphicon glyphicon-search"></span></button>
</div>
<script>

$("#my_btn").hover(function(){
	document.getElementById("btn_msg_div").style.display = "block";
}, function(){
    document.getElementById("btn_msg_div").style.display = "none";
});
</script>

<div id="demo" class="container collapse">
  {!! Form::open(['action'=>'ServiceOperations@search_service_ctrl', 'class'=>'navbar-form navbar-right']) !!}
        <div class="form-group">
   {{ Form::select('service_category', [
   'teaching-science' => 'Teaching-science',
   'teaching-language' => 'Teaching-language',
   'teaching-other' => 'Teaching-other',
   'repair-cycle' => 'Repair-cycle',
   'repair-automobile' => 'Repair-automobile',
   'repair-electronics' => 'Repair-electronics',
   'repair-other' => 'Repair-other',
   'social-elderly care' => 'Social-elderly care',
   'social-child care' => 'Social-child care',
   'social-fundraising' => 'Social-fundraising',
   'social-other' => 'Social-other',
   'animal-pet care' => 'Animal-pet care',
   'animal-pet adoption' => 'Animal-pet adoption',
   'animal-other' => 'Animal-other'], null, ['placeholder' => 'service category', 'class' => 'form-control', 'style' => 'margin:5px;']) }}

</div>
        <div class="form-group">
    <div class="form-check">
        {{ Form::radio('service_type', 'inquirer', true, ['class' => 'form-check-input']) }}
        Inquiries
    </div>
    <div class="form-check">
        {{ Form::radio('service_type', 'contributor', false, ['class' => 'form-check-input']) }}
        Contibutions
    </div>                                        
        </div>
        <div class="form-group">
{{ Form::text('user', '', array('type' => 'text', 'class' => 'form-control', 'style' => 'margin:5px;', 'id' => 'user', 'name' => 'user', 'placeholder' => 'user')) }}                                      
        </div>
        <div class="form-group">
{{ Form::text('city', '', array('type' => 'text', 'class' => 'form-control', 'style' => 'margin:5px;', 'id' => 'city', 'name' => 'city', 'placeholder' => 'city')) }}                                      
        </div>


        <button type="submit" class="btn btn-default">Search</button>
{!! Form::close() !!}
</div>

<!--<div class=container>
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <span class="page-link">Previous</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active">
      <span class="page-link">
        2
        <span class="sr-only">(current)</span>
      </span>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
 </div>-->
{!! $elems !!}

@endsection
