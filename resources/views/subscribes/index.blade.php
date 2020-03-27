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
                <h4 class="mt-5 mb-5">Subscribes</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('subscribes.subscribe.create') }}" class="btn btn-success" title="Create New Subscribe">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($subscribes) == 0)
            <div class="panel-body text-center">
                <h4>No Subscribes Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Subscribe</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($subscribes as $subscribe)
                        <tr>
                            <td>{{ $subscribe->email }}</td>
                            <td>{{ ($subscribe->subscribe) ? 'Yes' : 'No' }}</td>

                            <td>

                                <form method="POST" action="{!! route('subscribes.subscribe.destroy', $subscribe->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('subscribes.subscribe.show', $subscribe->id ) }}" class="btn btn-info" title="Show Subscribe">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('subscribes.subscribe.edit', $subscribe->id ) }}" class="btn btn-primary" title="Edit Subscribe">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Subscribe" onclick="return confirm(&quot;Click Ok to delete Subscribe.&quot;)">
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
            {!! $subscribes->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection