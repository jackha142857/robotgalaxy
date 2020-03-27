@extends('layouts.dashboard')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

	@if(count($options) == 0)
        <div class="panel-body text-center">
            <h4>No Options Available.</h4>
        </div>
    @endif
	
	
	<!-- DataTables -->
	<div class="card shadow mb-4">
    	<div class="card-header py-3"> 
           	<div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('options.option.create') }}" class="btn btn-success" title="Create New User">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true">Create New Option</span>
                </a>
        	</div>
        </div>
        <div class="card-body">
          	<div class="table-responsive">
            	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              		<thead>
                		<tr>                            
                            <th>Option</th>
							<th>Property</th>
							<th>Description</th>
							
                            <th></th>
              			</tr>
                  	</thead>
                    <tfoot>
                        <tr>
                            <th>Option</th>
							<th>Property</th>
							<th>Description</th>
							
                            <th></th>
                      	</tr>
                   	</tfoot>
                    <tbody>
                    @foreach($options as $option)
                        <tr>
                        	<td>
                        		<div class="alert alert-success" role="alert" style="text-align: center;">
                                      {{ $option->option }}
                                </div>
                            </td>
                            <td>{{ $option->Property->name }}</td>
                            <td>{{ $option->description }}</td>

                            <td>

                                <form method="POST" action="{!! route('options.option.destroy', $option->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
    
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('options.option.show', $option->id ) }}" class="btn btn-info" title="Show Property">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true">Detail</span>
                                        </a>
                                        <a href="{{ route('options.option.edit', $option->id ) }}" class="btn btn-primary" title="Edit Property">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>
                                        </a>
    
                                        <button type="submit" class="btn btn-danger" title="Delete Option" onclick="return confirm(&quot;Click Ok to delete Property.&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true">Delete</span>
                                        </button>
                                    </div>
    
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
          		</table>
          	</div>
    	</div>
  	</div>

@endsection