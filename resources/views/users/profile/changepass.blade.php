@extends('layouts.app')

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

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('profile', Auth::user()->id) }}" class="btn btn-dark" title="Show All User">
                    Go Back
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

            <form method="POST" action="{{ route('updatePassword', $user->id) }}" accept-charset="UTF-8" id="changepass_user_form" name="changepass_user_form" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('users.profile.changepassform', [
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


