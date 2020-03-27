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
                <h4 class="mt-5 mb-5">Mails</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('mails.mail.create') }}" class="btn btn-success" title="Create New Mail">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($mails) == 0)
            <div class="panel-body text-center">
                <h4>No Mails Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Sender User</th>
                            <th>State</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($mails as $mail)
                        <tr>
                            <td>{{ optional($mail->User)->id }}</td>
                            <td>{{ $mail->title }}</td>
                            <td>{{ $mail->content }}</td>
                            <td>{{ optional($mail->User)->id }}</td>
                            <td>{{ ($mail->state) ? 'Yes' : 'No' }}</td>

                            <td>

                                <form method="POST" action="{!! route('mails.mail.destroy', $mail->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('mails.mail.show', $mail->id ) }}" class="btn btn-info" title="Show Mail">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('mails.mail.edit', $mail->id ) }}" class="btn btn-primary" title="Edit Mail">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Mail" onclick="return confirm(&quot;Click Ok to delete Mail.&quot;)">
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
            {!! $mails->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection