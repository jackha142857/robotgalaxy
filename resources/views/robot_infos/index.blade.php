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
                <h4 class="mt-5 mb-5">Robot Infos</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('robot_infos.robot_info.create') }}" class="btn btn-success" title="Create New Robot Info">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($robotInfos) == 0)
            <div class="panel-body text-center">
                <h4>No Robot Infos Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Robot</th>
                            <th>Property</th>
                            <th>Content</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($robotInfos as $robotInfo)
                        <tr>
                            <td>{{ optional($robotInfo->Robot)->state }}</td>
                            <td>{{ optional($robotInfo->Property)->name }}</td>
                            <td>{{ $robotInfo->content }}</td>

                            <td>

                                <form method="POST" action="{!! route('robot_infos.robot_info.destroy', $robotInfo->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('robot_infos.robot_info.show', $robotInfo->id ) }}" class="btn btn-info" title="Show Robot Info">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('robot_infos.robot_info.edit', $robotInfo->id ) }}" class="btn btn-primary" title="Edit Robot Info">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Robot Info" onclick="return confirm(&quot;Click Ok to delete Robot Info.&quot;)">
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
            {!! $robotInfos->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection