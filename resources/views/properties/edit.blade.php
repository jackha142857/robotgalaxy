@extends('layouts.dashboard')

@section('content')

    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <div class="alert {{ $property->order ? "alert-success" : "alert-secondary" }}" role="alert" style="text-align: center;">
                      {{ !empty($property->name) ? $property->name : 'Property' }}
                </div>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('properties.property.index') }}" class="btn btn-dark" title="Show All Property">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true">Go Back</span>
                </a>

                <a href="{{ route('properties.property.create') }}" class="btn btn-success" title="Create New Property">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true">Create</span>
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

            <form method="POST" action="{{ route('properties.property.update', $property->id) }}" id="edit_property_form" name="edit_property_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('properties.form', [
                                        'property' => $property,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Update">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection