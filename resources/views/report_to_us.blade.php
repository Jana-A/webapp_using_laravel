@extends('layouts.app')
@section('content')
<div class="container">

    <div class="page-header">
        <h1>Contact Us</h1>
    </div>
    
    <div class="well">Have a question or comment? Fill out the following information and we will get back to you as soon as possible.</div>
    
    <form class="form-horizontal" method="post" role="form">
    	<div class="form-group">
    		<label for="email" class="col-sm-2 control-label">E-mail</label>
    		<div class="col-sm-4">
    			<input type="email" class="form-control" id="email" name="email" placeholder="E-mail Address" required autofocus>
    		</div>
    	</div>
    	
    	<div class="form-group">
    		<label for="name" class="col-sm-2 control-label">Name</label>
    		<div class="col-sm-4">
    			<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
    		</div>
    	</div>
    	
    	<div class="form-group">
    		<label for="name" class="col-sm-2 control-label">Message</label>
    		<div class="col-sm-6">
    			<textarea id="message" name="message" class="form-control" placeholder="Your Message" rows="5" required></textarea>
    		</div>
    	</div>
    
    	<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-6">
    			<button type="submit" class="btn btn-primary">Send Message</button>
    		</div>
    	</div>
    </form>

</div>

@endsection
