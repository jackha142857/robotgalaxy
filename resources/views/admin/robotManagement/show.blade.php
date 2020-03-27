@extends('layouts.admin')

@section('content')
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
<div class="container" style="background: white;">
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            @switch($robot->state)
            	@case(0)
            		<div class="alert alert-secondary" role="alert" style="text-align: center;">
                      	Robot ID: {{ $robot->id }}
                    </div>
            		@break
            	@case(1)
            		<div class="alert alert-success" role="alert" style="text-align: center;">
                      	Robot ID: {{ $robot->id }}
                    </div>
                    @break
               	@default
               		@break
          	@endswitch
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('robots.robot.destroy', $robot->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('robots.robot.index') }}" class="btn btn-dark" title="Show All Robot">
                        Go Back
                    </a>
                    <a href="{{ route('robots.robot.create') }}" class="btn btn-success" title="Create New Robot">
                        Create
                    </a>                    
                    <a href="{{ route('robots.robot.edit', $robot->id ) }}" class="btn btn-primary" title="Edit Robot">
                        Edit
                    </a>
                    <button type="submit" class="btn btn-danger" title="Delete Robot" onclick="return confirm(&quot;Click Ok to delete Robot.?&quot;)">
                        Delete
                    </button>
                </div>
            </form>

        </div>

    </div><br><br>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>User</dt>
            <dd>{{ optional($robot->User)->id }}</dd>
            <dt>State</dt>
            <dd>{{ ($robot->state) ? 'Active' : 'Inactive' }}</dd>
            
            @foreach($properties as $property)
            	<dt>{{ $property->name }}</dt>
            	@if(count($robot->robotInfos->where('property_id', $property->id)) > 0)
					<dd>
						{{ $robot->robotInfos->firstWhere('property_id', $property->id)->content }}
					</dd>
				@else
					<dd><i>N/A</i></dd>
				@endif
			@endforeach
            
            <dt>Created At</dt>
            <dd>{{ $robot->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $robot->updated_at }}</dd>

        </dl>

    </div>
</div>
</div>
</div>
@endsection