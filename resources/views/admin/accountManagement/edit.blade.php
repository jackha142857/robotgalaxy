@extends('layouts.admin')

@section('content')
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
<div class="container" style="background: white;">
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
            	@switch($user->privilege)
                	@case(0)
                		<div class="alert alert-danger" role="alert" style="text-align: center;">
                          {{ !empty($user->name) ? $user->name : 'User' }}
                        </div>
                		@break
                	@case(1)
                		<div class="alert alert-success" role="alert" style="text-align: center;">
                          {{ !empty($user->name) ? $user->name : 'User' }}
                        </div>
                		@break
                	@case(100)
                		<div class="alert alert-warning" role="alert" style="text-align: center;">
                          {{ !empty($user->name) ? $user->name : 'User' }}
                        </div>
                		@break
                	@default
                		<div class="alert alert-secondary" role="alert" style="text-align: center;">
                          {{ !empty($user->name) ? $user->name : 'User' }}
                        </div>
                	 	@break
                @endswitch
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('users.user.index') }}" class="btn btn-dark" title="Show All User">
                    Go Back
                </a>
                <a href="{{ route('users.user.create') }}" class="btn btn-success" title="Create New User">
                    Create
                </a>
            </div>
        </div><br><br>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('users.user.update', $user->id) }}" id="edit_user_form" name="edit_user_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin.accountManagement.editform', [
                                        'user' => $user,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Update">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
@endsection