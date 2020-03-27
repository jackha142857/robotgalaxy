@extends('layouts.admin')

@section('content')
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
<div class="container" style="background: white;">
    @if(Session::has('success_message'))
        <div class="row">
    		<div class="col-md-12 alert alert-success">
                {!! session('success_message') !!}    
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
        </div>
    @endif
        
    @if(count($robots) == 0)
        <div class="row">
    		<div class="col-md-12 panel-body text-center">
                <h4>No Robots Available.</h4>
        	</div>
        </div>
    @endif
    
    <!-- DataTables -->
	<div class="row">
		<div class="col-md-12 card shadow mb-4">
        	<div class="card-header py-3"> 
        		<table>
                    <thead>
                        <tr>
                            <th>
                            	<div class="alert alert-success" role="alert" style="text-align: center;">
                                      Active
                                </div>
                            </th>
                            <th>
                            	<div class="alert alert-secondary" role="alert" style="text-align: center;">
                                      Inactive
                                </div>
                            </th>
                        </tr>
                    </thead>
               	</table>	
               	<div class="btn-group btn-group-sm pull-right" role="group">
                    <a href="{{ route('robots.robot.create') }}" class="btn btn-success" title="Create New User">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true">Create New Robot</span>
                    </a>
            	</div>
            </div>
            <div class="card-body">
              	<div class="table-responsive">
                	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  		<thead>
                    		<tr>
                                <th></th>
                                <th>Uploader</th>
        						@foreach($properties as $property)
        							<th>{{ $property->name }}</th>    						
        						@endforeach
                  			</tr>
                      	</thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Uploader</th>
        						@foreach($properties as $property)
        							<th>{{ $property->name }}</th>    						
        						@endforeach
                          	</tr>
                       	</tfoot>
                        <tbody>
                        @foreach($robots as $robot)
                            <tr>
                            	<td>
                                    <form method="POST" action="{!! route('robots.robot.destroy', $robot->id) !!}" accept-charset="UTF-8">
                                    <input name="_method" value="DELETE" type="hidden">
                                    {{ csrf_field() }}
        
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('robots.robot.show', $robot->id ) }}" class="btn btn-info" title="Show Property">
                                                Detail
                                            </a>
                                            <a href="{{ route('robots.robot.edit', $robot->id ) }}" class="btn btn-primary" title="Edit Property">
                                                Edit
                                            </a>    
                                            <button type="submit" class="btn btn-danger" title="Delete Property" onclick="return confirm(&quot;Click Ok to delete Property.&quot;)">
                                                Delete
                                            </button>
                                        </div>    
                                    </form>                                
                                </td>
                                <td>
                                @switch($robot->state)
                                	@case(0)
                                		<div class="alert alert-secondary" role="alert" style="text-align: center;">
                                          	<a href="{{ route('users.user.show', optional($robot->User)->id == null ? '0' : optional($robot->User)->id) }}" class="alert-link">{{ optional($robot->User)->email }}</a>
                                        </div>
                                		@break
                                	@default
                                		<div class="alert alert-success" role="alert" style="text-align: center;">
                                          	<a href="{{ route('users.user.show', optional($robot->User)->id == null ? '0' : optional($robot->User)->id) }}" class="alert-link">{{ optional($robot->User)->email }}</a>
                                        </div>
                                	 	@break
                                @endswitch                            
                                </td>
    
    							@foreach($properties as $property)
    								@if(count($robot->robotInfos->where('property_id', $property->id)) > 0)
    									<td>
    										{{ $robot->robotInfos->firstWhere('property_id', $property->id)->content }}
    									</td>
    								@else
    									<td></td>
    								@endif
        						@endforeach                               
                            </tr>
                        @endforeach
                        </tbody>
              		</table>
              	</div>
        	</div>
      	</div>
  	</div>
</div>
</div>
@endsection