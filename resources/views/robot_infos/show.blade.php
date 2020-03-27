@extends('layouts.dashboard')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Robot Info' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('robot_infos.robot_info.destroy', $robotInfo->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('robot_infos.robot_info.index') }}" class="btn btn-primary" title="Show All Robot Info">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('robot_infos.robot_info.create') }}" class="btn btn-success" title="Create New Robot Info">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('robot_infos.robot_info.edit', $robotInfo->id ) }}" class="btn btn-primary" title="Edit Robot Info">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Robot Info" onclick="return confirm(&quot;Click Ok to delete Robot Info.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Robot</dt>
            <dd>{{ optional($robotInfo->Robot)->state }}</dd>
            <dt>Property</dt>
            <dd>{{ optional($robotInfo->Property)->name }}</dd>
            <dt>Content</dt>
            <dd>{{ $robotInfo->content }}</dd>
            <dt>Created At</dt>
            <dd>{{ $robotInfo->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $robotInfo->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection