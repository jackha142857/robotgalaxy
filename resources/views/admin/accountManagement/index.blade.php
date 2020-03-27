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
    
    @if(count($users) == 0)
        <div class="row">
    		<div class="col-md-12 panel-body text-center">
            	<h4>No User Available.</h4>
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
                            	<div class="alert alert-warning" role="alert" style="text-align: center;">
                                      Admin
                                </div>
                            </th>
                            <th>
                            	<div class="alert alert-success" role="alert" style="text-align: center;">
                                      User
                                </div>
                            </th>
                            <th>
                            	<div class="alert alert-danger" role="alert" style="text-align: center;">
                                      Banned
                                </div>
                            </th>
                            <th>
                            	<div class="alert alert-secondary" role="alert" style="text-align: center;">
                                      Others
                                </div>
                            </th>
                        </tr>
                    </thead>
               	</table>
               	<div class="btn-group btn-group-sm pull-right" role="group">
                    <a href="{{ route('users.user.create') }}" class="btn btn-success" title="Create New User">
                        Create New User
                    </a>
            	</div>
            </div>
            <div class="card-body" >
              	<div class="table-responsive" >
                	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  		<thead>
                    		<tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Dob</th>
    
                                <th></th>
                  			</tr>
                      	</thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Dob</th>
    
                                <th></th>
                          	</tr>
                       	</tfoot>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                @switch($user->privilege)
                                	@case(0)
                                		<div class="alert alert-danger" role="alert" style="text-align: center;">
                                          {{ $user->name }}
                                        </div>
                                		@break
                                	@case(1)
                                		<div class="alert alert-success" role="alert" style="text-align: center;">
                                          {{ $user->name }}
                                        </div>
                                		@break
                                	@case(100)
                                		<div class="alert alert-warning" role="alert" style="text-align: center;">
                                          {{ $user->name }}
                                        </div>
                                		@break
                                	@default
                                		<div class="alert alert-secondary" role="alert" style="text-align: center;">
                                          {{ $user->name }}
                                        </div>
                                	 	@break
                                @endswitch                            
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->dob }}</td>
    
                                <td>
    
                                    <form method="POST" action="{!! route('users.user.destroy', $user->id) !!}" accept-charset="UTF-8">
                                    <input name="_method" value="DELETE" type="hidden">
                                    {{ csrf_field() }}
    
                                        <div class="btn-group btn-group-sm pull-right" role="group">
                                        	<a href="{{ route('users.user.changepass', $user->id ) }}" class="btn btn-warning" title="Change Password">
                                                Change Pass
                                            </a>
                                            <a href="{{ route('users.user.show', $user->id ) }}" class="btn btn-info" title="Show User">
                                                Detail
                                            </a>
                                            <a href="{{ route('users.user.edit', $user->id ) }}" class="btn btn-primary" title="Edit User">
                                                Edit
                                            </a>
    
                                            <button type="submit" class="btn btn-danger" title="Delete User" onclick="return confirm(&quot;Click Ok to delete User.&quot;)">
                                                Delete
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
	</div>
</div>
</div>
@endsection