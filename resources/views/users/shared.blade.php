@extends('layouts.app')
@section('header')  
<style>
.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 10px;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidebar a {
  text-decoration: none;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>
@endsection
@section('content')
<div id="filterSideBar" class="sidebar">
	<form action="" id="filterForm">
	<div style="position: relative"><h2 id='hh' class="my-4">Filter</h2><i onclick="closeNav()" class="fa fa-times-circle" style="position: absolute; top: 10px; right: 10px;"></i></div>
	<a id='clear' href="#" onclick="document.getElementById('filterForm').reset();document.getElementById('submit').click();" class="btn btn-block btn-sm btn-danger"><i class="fas fa-eraser"></i> Clear</a><br>
    @foreach($filters as $filter)
    	<label style="color: IndianRed;">{{ $filter->name }}</label><br>
        @switch(optional($filter->InputType)->type)            	
            @case(0)
    			<input type="text" name="{{ $filter->name }}" class="form-control" placeholder="{{ $filter->name }}" onKeyUp="javascript:pagination(1);">
    			@break
    		@case(1)
    			<input type="radio" name="{{ $filter->name }}" value="" onclick="javascript:pagination(1);" checked>	All<br>
    			@foreach($filter->options as $option)
    					<input type="radio" name="{{ $filter->name }}" value="{{ $option->option }}" onclick="javascript:pagination(1);">	{{ $option->option }}<br>
    			@endforeach
    			@break
    		@case(2)
    		<?php $i = 0?>
    			@foreach($filter->options as $option)
    					<input type="checkbox" name="{{ $filter->name .'*'. ++$i}}" value="{{ $option->option }}" onclick="javascript:pagination(1);">	
    					{{ $option->option }}<br>
    			@endforeach
    			@break
    		@case(3)
    			<select name="{{ $filter->name }}" onchange="javascript:pagination(1);">
    					<option value="" selected>None</option>
    			@foreach($filter->options as $option)
    					 <option value="{{ $option->option }}">{{ $option->option }}</option>
    			@endforeach
    			</select><br>
    			@break
    		@case(10)
    			<input type="text" class="form-control" placeholder="{{ $filter->name }}" name="{{ $filter->name }}" onKeyUp="javascript:pagination(1);">
    			@break
    		@default
        @endswitch
    @endforeach 
    <br><br>
    <input type='text' name='page' id='page' hidden>
    <input type="submit" value="Submit" id='submit' hidden>
    </form>
</div>   
<div class="row" id="content">

</div>       
@endsection
@section('footer')  
	<script type="text/javascript">
  		$(document).ready(function(){        	
        	$.ajax({
                type : 'get',
                url : '{{ route('filterShared') }}',
                success:function(data){
					$('#content').html(data);
					var x = document.querySelectorAll(".pagination a");
					var i;
					var page;
					for (i = 0; i < x.length; i++) {
						page = x[i].getAttribute("href").split('=')[1];
						console.log(page);
					  	x[i].setAttribute("href", "javascript:pagination("+page+");");
					} 
                }
        	});       	
        })
        
        $("#filterForm").submit(function(event){
        	event.preventDefault(); //prevent default action 
        	var form_data = $(this).serialize(); //Encode form elements for submission        	
        	$.ajax({
        		type : 'get',
                url : '{{ route('filterShared') }}',
        		data : form_data,
        		success:function(data){
					$('#content').html(data);
					var x = document.querySelectorAll(".pagination a");
					var i;
					var page;
					for (i = 0; i < x.length; i++) {
						page = x[i].getAttribute("href").split('=')[1];
						console.log(page);
					  	x[i].setAttribute("href", "javascript:pagination("+page+");");
					} 
                }
        	});
        });

  		function pagination(page) {
  	  		$('#page').val(page);
  	  		document.getElementById('submit').click();
  		}

  		function unavailableImage(img) {
  	  		img.src = '{{ asset('img/unavailable-image.jpg') }}';
  		}
    </script>
<script>
    function openNav() {
      document.getElementById("filterSideBar").style.width = "250px";
      document.getElementById("content").style.marginLeft = "250px";
    }
    
    function closeNav() {
      document.getElementById("filterSideBar").style.width = "0";
      document.getElementById("content").style.marginLeft= "0";
    }
</script>
@endsection