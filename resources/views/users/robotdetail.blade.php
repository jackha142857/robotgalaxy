@extends('layouts.app')
@section('header')
<script>
function unavailableImage(img) {
		img.src = '{{ asset('img/unavailable-image.jpg') }}';
}
</script>
@endsection
@section('content')

<div class="container">
	@php
    	$collection = collect();	
    	foreach($robot->robotInfos as $robotInfo) {
    		$collection->push(['property' => $robotInfo->Property->name, 'content' => $robotInfo->content, 'order' => $robotInfo->Property->order]);
    	}
    	$sorted = $collection->sortBy('order')->where('order' , '>', 0);
    	$propertyName = $sorted->where('property', 'Name')->first();
    	$propertyImage = $sorted->where('property', 'Image')->first();
	@endphp
    <!-- Portfolio Item Heading -->
    <h1 class="my-4 text-primary">{{ $propertyName['content'] }}</h1>
    <input id="robotId" type="text" value="{{ $robot->id }}" hidden>
    @isset(Auth::user()->id)
    <input id="userId" type="text" value="{{ Auth::user()->id }}" hidden>
    @endisset
    
    <!-- Portfolio Item Row -->
    <div class="row">
        <div class="col-md-8" style="background-color:lightblue">
          <img style="max-width: 100%; border: 1px solid DarkGreen; border-radius: 50px;" src="{{ $propertyImage['content'] }}" alt="" onerror="unavailableImage(this);" width="800" height="600">
        </div>
        <div class="col-md-4" style="background-color:lightblue; height: 600px; overflow-y: scroll;">
        	@isset(Auth::user()->id)
            	<p align="center"><button type="button" class="btn btn-success" onclick="addSavedList({{ Auth::user()->id }}, {{ $robot->id }});" >Add to Saved List</button></p>
        	@endisset
        	@foreach($sorted as $robotInfo)
        		@if($robotInfo['property'] != "Image" && $robotInfo['property'] != "Name")
        			<p class="card-text"><strong>{{ $robotInfo['property'] }}&nbsp</strong>{{ $robotInfo['content'] }}</p>
        		@endif                        		
        	@endforeach
        </div>
  	</div>
    <!-- /.row -->

    <!-- Related Projects Row -->
    <h3 class="my-4 text-primary">Related Robots</h3>

    <div class="row">    
        <div class="col-md-3 col-sm-6 mb-4">
          <a href="#">
                <img class="card-img-top" width="200" height="150" src="{{ asset('img/robot/rb04.jpg') }}" alt="" style="border: 1px solid DarkGreen; border-radius: 50px;">
              </a>
        </div>        
        <div class="col-md-3 col-sm-6 mb-4">
          <a href="#">
                <img class="card-img-top" width="200" height="150" src="{{ asset('img/robot/rb03.jpg') }}" alt="" style="border: 1px solid DarkGreen; border-radius: 50px;">
              </a>
        </div>        
        <div class="col-md-3 col-sm-6 mb-4">
          <a href="#">
                <img class="card-img-top" width="200" height="150" src="{{ asset('img/robot/rb01.jpg') }}" alt="" style="border: 1px solid DarkGreen; border-radius: 50px;">
              </a>
        </div>        
        <div class="col-md-3 col-sm-6 mb-4">
          <a href="#">
                <img class="card-img-top" width="200" height="150" src="{{ asset('img/robot/rb02.jpg') }}" alt="" style="border: 1px solid DarkGreen; border-radius: 50px;">
              </a>
        </div>    
    </div>
    <!-- /.row -->

	<div class="row d-flex justify-content-center h-100">
    	<div class="col-md-8 col-md-offset-2">
    		<h3 class="my-4 text-primary">Comments</h3>
    		<div id="display-comment">
    		</div>
    	</div>
    </div>
    <br>
    @if(isset(Auth::user()->id))
    <div class="row d-flex justify-content-center h-100">
    	<div class="col-md-8">
        <form method="POST" action="{{ route('comment') }}" id="commentForm">
            @csrf
            <div class="form-group">
                <div class="col-md-12">
                    <textarea class="form-control" name="comment" id="comment"></textarea>
                    <input type="hidden" id="robot_id" name="robot_id" value="{{ $robot->id }}" />
                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}" />                                                                                                          
                </div> 
                <div class="col-md-12" align="center">
                <br>
                	<button class="btn btn-success" type="submit" id="addComment">Add Comment</button>
                </div>
            </div>                               
        </form>  
        </div>
	</div>
	@endif
</div>
<!-- /.container -->
@endsection

@section('footer')
<script type="text/javascript">
	function addSavedList(userId, robotId) {
		$.ajax({
    		type : 'get',
            url : '{{ route('addSavedList') }}',
    		data : { user_id: userId, robot_id: robotId },
    		success:function(data){
        		alert(data);
            }
    	});
	}
	
	$("#commentForm").submit(function(event){
    	event.preventDefault(); //prevent default action 
    	var form_data = $(this).serialize(); //Encode form elements for submission        	
    	$.ajax({
    		type : 'post',
            url : '{{ route('comment') }}',
    		data : form_data,
    		success:function(data){
				//alert(data);  
				getComment();
            }
    	});
		
    });

	$(document).ready(function(){
		getComment();      	
    })
    
    function getComment() {
		var robot_id = $("#robotId").val();
		var url = '{{ route('getComment', ':id') }}';   
		url = url.replace(':id', robot_id);         	
    	$.ajax({
            type : 'get',
            url : url,
            success:function(data){
				$('#display-comment').html(data);
            }
    	}); 
	}

	function deleteComment(commentId) {
		var url = '{{ route('deleteComment', ':id') }}';   
		url = url.replace(':id', commentId);         	
    	$.ajax({
            type : 'delete',
            url : url,
            success:function(data){
            	getComment();
            }
    	}); 
	}
	
	function showReplyBox(commentId) {
		var robot_id = $("#robotId").val();
		var user_id = $("#userId").val();
		var commentReplyBoxId = '#rp' + commentId;
		var html = `<form method="POST" action="{{ route('comment') }}" id="commentForm">
            @csrf
            <div class="form-group">
                <div class="col-md-12">
                    <textarea class="form-control" name="comment" id="comment"></textarea>
                    <input type="hidden" id="robot_id" name="robot_id" value="` + robot_id + `" />
                    <input type="hidden" id="user_id" name="user_id" value="` + user_id + `" /> 
                    <input type="hidden" id="comment_id" name="comment_id" value="` + commentId + `" />                                                                                                         
                </div> 
                <div class="col-md-12" align="center">
                <br>
                	<button class="btn btn-success" type="submit" id="addComment">Reply</button>
                </div>
            </div>                               
        </form>  `;
		$(commentReplyBoxId).html(html);
		$("#commentForm").submit(function(event){
	    	event.preventDefault(); //prevent default action 
	    	var form_data = $(this).serialize(); //Encode form elements for submission        	
	    	$.ajax({
	    		type : 'post',
	            url : '{{ route('comment') }}',
	    		data : form_data,
	    		success:function(data){
					//alert(data);  
					getComment();
	            }
	    	});
			
	    });
	}
</script>
@endsection