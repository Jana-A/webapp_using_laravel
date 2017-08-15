<style type="text/css">
.well {
  background-color: #e7594b;/*7f7fe6*/
  color: #FFFFFF;
}
</style>

<div class="container">
<button type="button" style="float:right;margin-right:10px;width:20%;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add A Service <span class="glyphicon glyphicon-plus-sign"></span></button>
<!-- Modal -->
<div id="myModal" class="modal fade bd-example-modal-lg" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="padding:10px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add A Service</h4>
      </div>

{!! Form::open(['action'=>'ServiceOperations@add_service_ctrl']) !!}
<fieldset class="form-group">
{{ Form::label('Service Category') }}

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
   'animal-other' => 'Animal-other'], 'Teaching-science', ['default' => 'Teaching-science', 'class' => 'form-control']) }}

</fieldset>

  <fieldset class="form-group">
    {{ Form::label('Service Type') }}
    <div class="form-check">
        {{ Form::radio('service_type', 'inquirer', true, ['class' => 'form-check-input']) }}
        I am looking for assistance
    </div>
    <div class="form-check">
        {{ Form::radio('service_type', 'contributor', false, ['class' => 'form-check-input']) }}
        I am offering assistance
    </div>
  </fieldset>

<fieldset class="form-group">
<div class="form-check row">
  <div class="form-group col-xs-4">
    {{ Form::label('City') }}
    {{ Form::text('city', '', array('type' => 'text', 'class' => 'form-control', 'id' => 'city', 'name' => 'city', 'placeholder' => 'city')) }}
  </div>
  <div class="form-group col-xs-4">
{{ Form::label('Country') }}
{{ Form::select('country', [
   'null' => '',
   'belgium' => 'Belgium',
   'sweden' => 'Sweden',
   'china' => 'China',
   'denmark' => 'Denmark',
   'canada' => 'Canada',
   'united kingdom' => 'United Kingdom',
   'united states' => 'United States',
   'germany' => 'Germany']
), null, ['class' => 'form-control'] }}
  </div>
</div>
</fieldset>


<fieldset>
  <div class="form-check row">
  <div class="form-group col-xs-4">
    {{ Form::label('Start') }}
    {{ Form::date('start', \Carbon\Carbon::now()) }}

  </div>
  <div class="form-group col-xs-4">

    {{ Form::label('End') }}
    {{ Form::date('end') }}

</div>
</div>
</fieldset>


  <fieldset class="form-group">
  <div class="form-group">
    {{ Form::label('Give a brief description of what you are looking for:') }}
    {{ Form::textarea('description', null, ['size' => '30x3', 'class' => 'form-control']) }}
  </div>
    </fieldset>

<button type="submit" class="btn btn-inverse"/>Add</button>
{!! Form::close() !!}
    </div>

  </div>
</div>
</div>
