@extends('layouts.admin')

@section('content')
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
<div class="container" style="background: white;">
    <div class="panel panel-default">

        <div class="panel-heading clearfix">            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">Create New Robot</h4>
            </span>
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('robots.robot.index') }}" class="btn btn-dark" title="Show All Robot">
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

            <form method="POST" action="{{ route('robots.robot.store') }}" accept-charset="UTF-8" id="create_robot_form" name="create_robot_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('admin.robotManagement.createform', [
                                        'robot' => null,
                                        'properties' => $properties
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


