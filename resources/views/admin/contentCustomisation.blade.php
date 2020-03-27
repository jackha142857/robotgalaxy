@extends('layouts.admin')

@section('content')
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
<div class="container" style="background: white;">
	<div class="row">
		<div class="col-md-12 alert alert-info">  
			<label id='result'></label>
		</div>     
	</div>
	<div class="row">
        <div class="col-md-6 alert alert-primary">            
    		Properties
        </div>        
        <div class="col-md-6 alert alert-primary">
            Options
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" id="propertyContent">
        </div>
        <div class="col-md-6" id="optionContent">
        </div>
    </div>
    <div class="row">  
    	<div class="col-md-12 alert alert-primary">
        	Configuration
        </div>  	
        <div class="col-md-12" id="configContent">
        </div>
    </div>
</div>
</div>
@endsection

@section('footer')
<script type="text/javascript">
  		$(document).ready(function(){        	
        	getProperties();     	
        })
        
        function getProperties() {
  			$.ajax({
                type : 'get',
                url : '{{ route('getProperties') }}',
                success:function(data){
					$('#propertyContent').html(data);
                }
        	});  
  		}
  		
        function getOptions(propertyId) {
  			$.ajax({
                type : 'get',
                data: {propertyId: propertyId},
                url : '{{ route('getOptions') }}',
                success:function(data){
					$('#optionContent').html(data);
                }
        	});
  		}

        function addProperty() {
            var name = $('#newPropertyName').val();
            $.ajax({
            	type : 'post',
                data: { name: name },
                url : '{{ route('addProperty') }}',
                success:function(data){
                	getProperties(); 
                	$('#result').html(data);
                }
        	});  
  		}

        function addOption() {
            var option = $('#newOptionName').val();
            var property_id = $("#propertyId").val();
            $.ajax({
            	type : 'post',
                data: { option: option, property_id: property_id },
                url : '{{ route('addOption') }}',
                success:function(data){
                	getOptions(property_id);
                	$('#result').html(data);
                }
        	});  
  		}

        function deleteProperty(propertyId) {
        	var r = confirm("You are removing a property?");
        	if (r == true) {
        		var url = '{{ route('deleteProperty', ':id') }}';   
    			url = url.replace(':id', propertyId); 
                $.ajax({
                	type : 'delete',
                    url : url,
                    success:function(data){
                    	getProperties(); 
                    }
            	});  
        	} else {        	  
        	}         	
  		}   

        function deleteOption(optionId) {
        	var r = confirm("You are removing an option?");
        	if (r == true) {
    			var property_id = $("#propertyId").val();
        		var url = '{{ route('deleteOption', ':id') }}';   
    			url = url.replace(':id', optionId); 
                $.ajax({
                	type : 'delete',
                    url : url,
                    success:function(data){
                    	getOptions(property_id);
                    	getProperties(); 
                    }
            	});  
        	} else {        	  
        	}         	
  		}         

        function getPropertyConfig(propertyId) {
  			$.ajax({
                type : 'get',
                data: {propertyId: propertyId},
                url : '{{ route('getPropertyConfig') }}',
                success:function(data){
					$('#configContent').html(data);
                }
        	}); 
  		}

        function getOptionConfig(optionId) {
  			$.ajax({
                type : 'get',
                data: {optionId: optionId},
                url : '{{ route('getOptionConfig') }}',
                success:function(data){
					$('#configContent').html(data);
                }
        	}); 
  		}
  		
        function updateProperty(){
			var id = $("#propertyId").val();
			var name = $("#name").val();
			var input_type_id = $("#input_type_id").val();
			var order = $("#order").val();
			var description = $("#description").val();
			var filter = $("#filter").val();	
			var url = '{{ route('updateProperty', ':id') }}';   
			url = url.replace(':id', id);   	
        	$.ajax({
        		type : 'put',
                url : url,
                data: { name: name, input_type_id: input_type_id, order: order, description: description, filter: filter },
        		success:function(data){
        			getProperties();  
        			getOptions(id); 
					$('#result').html(data);
                }
        	});
        }   

        function updateOption(){
			var id = $("#optionId").val();
			var property_id = $("#propertyId").val();
			var option = $("#option").val();
			var description = $("#description").val();
			var url = '{{ route('updateOption', ':id') }}';   
			url = url.replace(':id', id); 
        	$.ajax({
        		type : 'put',
                url : url,
                data: { property_id: property_id, option: option, description: description },
        		success:function(data){
        			getProperties();  
        			getOptions(property_id); 
					$('#result').html(data);
                }
        	});
        }      

        function updatePropertyOrder(propertyId, newOrder) {
        	var url = '{{ route('updateProperty', ':id') }}';   
			url = url.replace(':id', propertyId); 
  			$.ajax({
                type : 'put',
                data: { order: newOrder },
                url : url,
                success:function(data){
                	getProperties(); 
                }
        	}); 
  		}  

        function updatePropertyFilter(propertyId, newFilter) {
        	var url = '{{ route('updateProperty', ':id') }}';   
			url = url.replace(':id', propertyId); 
  			$.ajax({
                type : 'put',
                data: { filter: newFilter },
                url : url,
                success:function(data){
                	getProperties(); 
                }
        	}); 
  		}  
    </script>
@endsection