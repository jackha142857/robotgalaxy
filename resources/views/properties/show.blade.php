@extends('layouts.dashboard')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <div class="alert {{ $property->order ? "alert-success" : "alert-secondary" }}" role="alert" style="text-align: center;">
                  {{ isset($property->name) ? $property->name : 'Property' }}
            </div>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('properties.property.destroy', $property->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('properties.property.index') }}" class="btn btn-dark" title="Show All Property">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true">Go Back</span>
                    </a>

                    <a href="{{ route('properties.property.create') }}" class="btn btn-success" title="Create New Property">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true">Create</span>
                    </a>
                    
                    <a href="{{ route('properties.property.edit', $property->id ) }}" class="btn btn-primary" title="Edit Property">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Property" onclick="return confirm(&quot;Click Ok to delete Property.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true">Delete</span>
                    </button>
                </div>
            </form>

        </div>

    </div><br><br>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $property->name }}</dd>
            <dt>Description</dt>
            <dd>{{ $property->description }}</dd>
            <dt>Input Type</dt>
            <dd>{{ optional($property->InputType)->name }}</dd>
            <dt>Number of options</dt>
            <dd>{{ count($property->options) }}</dd>
            <dt>Order</dt>
            <dd>{{ $property->order }}</dd>
            <dt>Filter</dt>
            <dd>{{ $property->filter }}</dd>
            <dt>Created At</dt>
            <dd>{{ $property->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $property->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection