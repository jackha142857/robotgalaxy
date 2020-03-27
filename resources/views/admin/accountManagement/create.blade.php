@extends('layouts.admin')

@section('content')
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
<div class="container" style="background: white;">
    <div class="panel panel-default">

        <div class="panel-heading clearfix">            
            <span class="pull-left">
            	<div class="alert alert-success" role="alert" style="text-align: center;">
                      Create New User
                </div>
            </span>
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('users.user.index') }}" class="btn btn-dark" title="Show All User">
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

            <form method="POST" action="{{ route('users.user.store') }}" accept-charset="UTF-8" id="create_user_form" name="create_user_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('admin.accountManagement.createform', [
                                        'user' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Add">
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
</div>
@endsection


