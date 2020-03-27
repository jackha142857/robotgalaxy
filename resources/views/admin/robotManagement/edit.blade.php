@extends('layouts.admin')

@section('content')
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
<div class="container" style="background: white;">
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Robot' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('robots.robot.index') }}" class="btn btn-dark" title="Show All Robot">
                    Go Back
                </a>
                <a href="{{ route('robots.robot.create') }}" class="btn btn-success" title="Create New Robot">
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

            <form method="POST" action="{{ route('robots.robot.update', $robot->id) }}" id="edit_robot_form" name="edit_robot_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin.robotManagement.editform', [
                                        'robot' => $robot,
                                        'properties' => $properties,
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