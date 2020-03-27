@extends('layouts.dashboard')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($inputType->name) ? $inputType->name : 'Input Type' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('input_types.input_type.destroy', $inputType->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('input_types.input_type.index') }}" class="btn btn-primary" title="Show All Input Type">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('input_types.input_type.create') }}" class="btn btn-success" title="Create New Input Type">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('input_types.input_type.edit', $inputType->id ) }}" class="btn btn-primary" title="Edit Input Type">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Input Type" onclick="return confirm(&quot;Click Ok to delete Input Type.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Type</dt>
            <dd>{{ $inputType->type }}</dd>
            <dt>Name</dt>
            <dd>{{ $inputType->name }}</dd>
            <dt>Created At</dt>
            <dd>{{ $inputType->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $inputType->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection