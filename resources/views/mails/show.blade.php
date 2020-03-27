@extends('layouts.dashboard')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($mail->title) ? $mail->title : 'Mail' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('mails.mail.destroy', $mail->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('mails.mail.index') }}" class="btn btn-primary" title="Show All Mail">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('mails.mail.create') }}" class="btn btn-success" title="Create New Mail">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('mails.mail.edit', $mail->id ) }}" class="btn btn-primary" title="Edit Mail">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Mail" onclick="return confirm(&quot;Click Ok to delete Mail.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>User</dt>
            <dd>{{ optional($mail->User)->id }}</dd>
            <dt>Title</dt>
            <dd>{{ $mail->title }}</dd>
            <dt>Content</dt>
            <dd>{{ $mail->content }}</dd>
            <dt>Sender User</dt>
            <dd>{{ optional($mail->User)->id }}</dd>
            <dt>State</dt>
            <dd>{{ ($mail->state) ? 'Yes' : 'No' }}</dd>
            <dt>Created At</dt>
            <dd>{{ $mail->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $mail->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection