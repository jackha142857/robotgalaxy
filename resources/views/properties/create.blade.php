@extends('layouts.dashboard')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
            	<div class="alert alert-success" role="alert" style="text-align: center;">
                      Create New Property
                </div>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('properties.property.index') }}" class="btn btn-dark" title="Show All Property">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true">Go Back</span>
                </a>
            </div>

        </div><br><br>

        <div class="panel-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('properties.property.store') }}" accept-charset="UTF-8" id="create_property_form" name="create_property_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('properties.form', [
                                        'property' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Add">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


