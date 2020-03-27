@extends('layouts.admin')

@section('content')
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
<div class="container" style="background: white;">
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
        	@switch($user->privilege)
            	@case(0)
            		<div class="alert alert-danger" role="alert" style="text-align: center;">
                      {{ isset($user->name) ? $user->name : 'User' }}
                    </div>
            		@break
            	@case(1)
            		<div class="alert alert-success" role="alert" style="text-align: center;">
                      {{ isset($user->name) ? $user->name : 'User' }}
                    </div>
            		@break
            	@case(100)
            		<div class="alert alert-warning" role="alert" style="text-align: center;">
                      {{ isset($user->name) ? $user->name : 'User' }}
                    </div>
            		@break
            	@default
            		<div class="alert alert-secondary" role="alert" style="text-align: center;">
                      {{ isset($user->name) ? $user->name : 'User' }}
                    </div>
            	 	@break
            @endswitch
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('users.user.destroy', $user->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('users.user.index') }}" class="btn btn-dark" title="Show All User">
                        Go Back
                    </a>
                    <a href="{{ route('users.user.create') }}" class="btn btn-success" title="Create New User">
                        Create
                    </a>                    
                    <a href="{{ route('users.user.edit', $user->id ) }}" class="btn btn-primary" title="Edit User">
                        Edit
                    </a>
                    <button type="submit" class="btn btn-danger" title="Delete User" onclick="return confirm(&quot;Click Ok to delete User.?&quot;)">
                        Delete
                    </button>
                </div>
            </form>

        </div>

    </div><br><br>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $user->name }}</dd>
            <dt>Email</dt>
            <dd>{{ $user->email }}</dd>
            <dt>Email Verified At</dt>
            <dd>{{ $user->email_verified_at }}</dd>
            <dt>Password</dt>
            <dd>{{ $user->password }}</dd>
            <dt>Phone</dt>
            <dd>{{ $user->phone }}</dd>
            <dt>Address</dt>
            <dd>{{ $user->address }}</dd>
            <dt>Dob</dt>
            <dd>{{ $user->dob }}</dd>
            <dt>Avatar</dt>
            <dd>{{ $user->avatar }}</dd>
            <dt>Privilege</dt>
            <dd>
			@switch($user->privilege)
            	@case(0)
            		<div class="alert alert-danger" role="alert" style="text-align: center;">
                      Banned
                    </div>
            		@break
            	@case(1)
            		<div class="alert alert-success" role="alert" style="text-align: center;">
                      User
                    </div>
            		@break
            	@case(100)
            		<div class="alert alert-warning" role="alert" style="text-align: center;">
                      Admin
                    </div>
            		@break
            	@default
            		<div class="alert alert-secondary" role="alert" style="text-align: center;">
                      Others
                    </div>
            	 	@break
            @endswitch
			</dd>
            <dt>Remember Token</dt>
            <dd>{{ $user->remember_token }}</dd>
            <dt>Created At</dt>
            <dd>{{ $user->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $user->updated_at }}</dd>

        </dl>

    </div>
</div>
</div>
</div>
@endsection