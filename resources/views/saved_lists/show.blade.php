@extends('layouts.dashboard')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Saved List' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('saved_lists.saved_list.destroy', $savedList->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('saved_lists.saved_list.index') }}" class="btn btn-primary" title="Show All Saved List">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('saved_lists.saved_list.create') }}" class="btn btn-success" title="Create New Saved List">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('saved_lists.saved_list.edit', $savedList->id ) }}" class="btn btn-primary" title="Edit Saved List">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Saved List" onclick="return confirm(&quot;Click Ok to delete Saved List.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>User</dt>
            <dd>{{ optional($savedList->User)->id }}</dd>
            <dt>Robot</dt>
            <dd>{{ optional($savedList->Robot)->state }}</dd>
            <dt>Created At</dt>
            <dd>{{ $savedList->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $savedList->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection