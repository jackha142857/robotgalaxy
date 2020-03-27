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
                <h4 class="mt-5 mb-5">Saved Lists</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('saved_lists.saved_list.create') }}" class="btn btn-success" title="Create New Saved List">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($savedLists) == 0)
            <div class="panel-body text-center">
                <h4>No Saved Lists Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Robot</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($savedLists as $savedList)
                        <tr>
                            <td>{{ optional($savedList->User)->id }}</td>
                            <td>{{ optional($savedList->Robot)->state }}</td>

                            <td>

                                <form method="POST" action="{!! route('saved_lists.saved_list.destroy', $savedList->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('saved_lists.saved_list.show', $savedList->id ) }}" class="btn btn-info" title="Show Saved List">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('saved_lists.saved_list.edit', $savedList->id ) }}" class="btn btn-primary" title="Edit Saved List">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Saved List" onclick="return confirm(&quot;Click Ok to delete Saved List.&quot;)">
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
            {!! $savedLists->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection