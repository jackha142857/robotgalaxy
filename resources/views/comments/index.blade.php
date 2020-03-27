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
                <h4 class="mt-5 mb-5">Comments</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('comments.comment.create') }}" class="btn btn-success" title="Create New Comment">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($comments) == 0)
            <div class="panel-body text-center">
                <h4>No Comments Available.</h4>
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

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ optional($comment->Robot)->id }}</td>
                            <td>{{ optional($comment->User)->id }}</td>
                            <td>{{ optional($comment->ParentComment)->id }}</td>

                            <td>

                                <form method="POST" action="{!! route('comments.comment.destroy', $comment->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('comments.comment.show', $comment->id ) }}" class="btn btn-info" title="Show Comment">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('comments.comment.edit', $comment->id ) }}" class="btn btn-primary" title="Edit Comment">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Comment" onclick="return confirm(&quot;Click Ok to delete Comment.&quot;)">
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
            {!! $comments->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection