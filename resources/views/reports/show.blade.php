@extends('layouts.dashboard')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Report' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('reports.report.destroy', $report->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('reports.report.index') }}" class="btn btn-primary" title="Show All Report">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('reports.report.create') }}" class="btn btn-success" title="Create New Report">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('reports.report.edit', $report->id ) }}" class="btn btn-primary" title="Edit Report">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Report" onclick="return confirm(&quot;Click Ok to delete Report.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Robot</dt>
            <dd>{{ optional($report->Robot)->id }}</dd>
            <dt>User</dt>
            <dd>{{ optional($report->User)->id }}</dd>
            <dt>Comment</dt>
            <dd>{{ $report->comment }}</dd>
            <dt>State</dt>
            <dd>{{ ($report->state) ? 'Yes' : 'No' }}</dd>
            <dt>Created At</dt>
            <dd>{{ $report->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $report->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection