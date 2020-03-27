@extends('layouts.dashboard')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Subscribe' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('subscribes.subscribe.destroy', $subscribe->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('subscribes.subscribe.index') }}" class="btn btn-primary" title="Show All Subscribe">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('subscribes.subscribe.create') }}" class="btn btn-success" title="Create New Subscribe">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('subscribes.subscribe.edit', $subscribe->id ) }}" class="btn btn-primary" title="Edit Subscribe">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Subscribe" onclick="return confirm(&quot;Click Ok to delete Subscribe.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Email</dt>
            <dd>{{ $subscribe->email }}</dd>
            <dt>Subscribe</dt>
            <dd>{{ ($subscribe->subscribe) ? 'Yes' : 'No' }}</dd>
            <dt>Created At</dt>
            <dd>{{ $subscribe->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $subscribe->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection