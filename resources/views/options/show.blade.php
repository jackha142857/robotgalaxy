@extends('layouts.dashboard')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
        	<div class="alert alert-success" role="alert" style="text-align: center;">
        		{{ isset($option->option) ? $option->option : 'Option' }}
        	</div>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('options.option.destroy', $option->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('options.option.index') }}" class="btn btn-dark" title="Show All Option">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true">Go Back</span>
                    </a>

                    <a href="{{ route('options.option.create') }}" class="btn btn-success" title="Create New Option">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true">Create</span>
                    </a>
                    
                    <a href="{{ route('options.option.edit', $option->id ) }}" class="btn btn-primary" title="Edit Option">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Option" onclick="return confirm(&quot;Click Ok to delete Option.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true">Delete</span>
                    </button>
                </div>
            </form>

        </div>

    </div><br><br>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Option</dt>
            <dd>{{ $option->option }}</dd>
            <dt>Property</dt>
            <dd>{{ optional($option->Property)->name }}</dd>
            <dt>Description</dt>
            <dd>{{ $option->description }}</dd>
            <dt>Created At</dt>
            <dd>{{ $option->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $option->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection