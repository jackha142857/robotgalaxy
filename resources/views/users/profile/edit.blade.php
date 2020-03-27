@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
<div class="container" style="background: white;">
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">
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
        </div><br><br>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('updateProfile', $user->id) }}" id="edit_user_form" name="edit_user_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('users.profile.editform', [
                                        'user' => $user,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                    	<br>
                        <input class="btn btn-primary" type="submit" value="Update">
                        <a class="btn btn-danger" href="{{ route('changepassword', $user->id) }}" role="button">Change Password</a> <br>  <br>                       
                    </div>
                    <div class="col-md-offset-2 col-md-10">
                        <a class="btn btn-success" href="#" role="button">Subscribe</a>
                        <span class="alert alert-primary" role="alert">
                          Currently do not receive any news by email!
                        </span>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
@endsection