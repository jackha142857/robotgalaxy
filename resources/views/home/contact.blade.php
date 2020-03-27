@extends('layouts.home')
@section('header')
@endsection
@section('content')  
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
	<div class="row mx-auto">
		<div class="col-md-12 text-center">
			<h1 class="mx-auto mb-5 text-uppercase">Let's chat</h1>
		</div>
		<div class="col-md-6 text-center"  style="color:white;">
        	<p>Feel free to get in touch with us. We are always open to discussing new projects, 
        	creative ideas or opportunities to be part of your visions.</p>
            <div>
             Company:  <a href="https://www.westernsydney.edu.au/">Western Sydney University</a>
            </div>
            <div>
             Address: <a href="#">Kingswood Campus</a>
            </div>
            <div>
              Phone:  <a href="#">+61 450 888 222</a>
            </div>        
            <div>
              Website:  <a href="https://www.westernsydney.edu.au/">www.westernsydney.edu.au</a>
            </div>
            <div>
               Program: <a href="#">Mon to Fri: 09:30 AM - 04.30 PM</a>
            </div>
            <br>
            <br>
            <br>
            <div id="result">
                <!-- Sending mail status -->
            </div>
		</div>
        <!-- contact form -->
        <div class="col-md-6">
			<form role="form" method="get" id="contactForm" name="contactForm" data-toggle="validator">
                <!-- Name -->
                <div class="form-group label-floating">
                	<label class="control-label" for="name" style="color: Pink;">Name</label>
                	<input class="form-control" id="name" type="text" name="name" required data-error="Please enter your name">
                	<div class="help-block with-errors"></div>
                </div>
                <!-- sender -->
                <div class="form-group label-floating">
                    <label class="control-label" for="sender" style="color: Pink;">Email</label>
                    <input class="form-control" id="sender" type="email" name="sender" required data-error="Please enter your Email">
                    <div class="help-block with-errors"></div>
                </div>
                <!-- receiver -->
                <div class="form-group label-floating" hidden>
                    <label class="control-label" for="receiver">Email</label>
                    <input class="form-control" id="receiver" type="email" name="receiver" required data-error="Please enter your Email" value="admin@robotgalaxy.online">
                    <div class="help-block with-errors"></div>
                </div>
                <!-- Subject -->
                <div class="form-group label-floating">
                    <label class="control-label" for="subject" style="color: Pink;">Subject</label>
                    <input class="form-control" id="subject" type="text" name="subject" required data-error="Please enter your message subject">
                    <div class="help-block with-errors"></div>
                    </div>
                <!-- Message -->
                <div class="form-group label-floating">
                    <label for="content" class="control-label" style="color: Pink;">Message</label>
                    <textarea class="form-control" rows="3" id="content" name="content" required data-error="Write your message"></textarea>
                    <div class="help-block with-errors"></div>
                </div>
                <!-- Form Submit -->
                <div class="form-submit mt-5">
                    <button class="btn btn-primary" type="submit" id="form-submit">Send Over</button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                    <div class="clearfix"></div>
                </div>
          </form>
      </div>
  </div>
</div>
@endsection
@section('footer')
    <!-- 	Ajax sending email -->
	<script type="text/javascript">        
        $("#contactForm").submit(function(event){
        	event.preventDefault(); //prevent default action 
        	var form_data = $(this).serialize(); //Encode form elements for submission 	
        	$('#result').html('<h3 style="color: #ff99cc;">Email is sending! Please wait!!!</h3>');
        	$.ajax({
        		type : 'get',
                url : '{{ route('sendmail') }}',
        		data : form_data,
        		success:function(data){
					$('#result').html('<h3 style="color: lime;">' + data + '</h3>');
                }
        	});
        });
    </script>
@endsection
 
