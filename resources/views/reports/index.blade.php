@extends('layouts.dashboard')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Reports</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('reports.report.create') }}" class="btn btn-success" title="Create New Report">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($reports) == 0)
            <div class="panel-body text-center">
                <h4>No Reports Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Robot</th>
                            <th>User</th>
                            <th>Comment</th>
                            <th>State</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>{{ optional($report->Robot)->id }}</td>
                            <td>{{ optional($report->User)->id }}</td>
                            <td>{{ $report->comment }}</td>
                            <td>{{ ($report->state) ? 'Yes' : 'No' }}</td>

                            <td>

                                <form method="POST" action="{!! route('reports.report.destroy', $report->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('reports.report.show', $report->id ) }}" class="btn btn-info" title="Show Report">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('reports.report.edit', $report->id ) }}" class="btn btn-primary" title="Edit Report">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Report" onclick="return confirm(&quot;Click Ok to delete Report.&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $reports->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection