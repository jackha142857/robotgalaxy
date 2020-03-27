@extends('layouts.app')

@section('content')
<h1 class="mx-auto mb-5 text-uppercase" align="center"><br>Upload Form</h1>
@if(Session::has('success_message'))
    <div class="alert alert-success">
        <span class="glyphicon glyphicon-ok"></span>
        {!! session('success_message') !!}

        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif
@if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
    
<form method="POST" action="{{ route('robots.robot.upload') }}" accept-charset="UTF-8" id="create_robot_form" name="create_robot_form" class="form-horizontal">
            {{ csrf_field() }}
            
<input class="form-control" name="user_id" type="text" id="user_id" value="{{ Auth::user() !== null ? Auth::user()->id : 2 }}" hidden>
<input class="form-control" name="state" type="checkbox" id="state" value="0" hidden>

@foreach($properties as $property)
	<div class="form-group">
		<label for="{{ $property->name }}" class="col-md-2 control-label" style="color: IndianRed;"><b>>{{ $property->name }}</b></label><br>
		<i>{{ $property->description }}</i>
		<div class="col-md-10">
		@switch($property->InputType->type)
			@case(0)
				<input class="form-control" name="{{ $property->name }}" type="{{ $property->name == 'Year' ? 'number' : 'text' }}"  id="{{ $property->name }}" value="{{ old($property->name) }}" minlength="1" maxlength="255" required>
        		{!! $errors->first('$property->name', '<p class="help-block">:message</p>') !!}
				@break
			@case(1)
				<input type="radio" name="{{ $property->name }}" value="" hidden checked>
				@foreach($property->options as $option)
				<input type="radio" name="{{ $property->name }}" value="{{ $option->option }}" {{ old($property->name) == $option->option ? 'checked' : '' }}>&nbsp&nbsp&nbsp&nbsp{{ $option->option }}</br>
				@endforeach				
				@break
			@case(2)
				<input type="checkbox" name="{{ $property->name }}[]" value="" hidden checked>
				@foreach($property->options as $option)
				<input type="checkbox" name="{{ $property->name }}[]" value="{{ $option->option }}" @if(old($property->name) !== null) {{ in_array($option->option, old($property->name)) ? 'checked' : '' }} @endif>&nbsp&nbsp&nbsp&nbsp{{ $option->option }}<br>
				@endforeach
				@break
			@case(3)
				<select name="{{ $property->name }}">
				<option value="" selected></option>
				@foreach($property->options as $option)
				<option value="{{ $option->option }}" {{ old($property->name) == $option->option ? 'selected' : '' }}>&nbsp&nbsp&nbsp&nbsp{{ $option->option }}</option>
				@endforeach
				</select>
				@break
			@case(10)
				<input class="form-control" name="{{ $property->name }}" type="text" id="{{ $property->name }}" value="" minlength="0" maxlength="255" required>
        		{!! $errors->first('$property->name', '<p class="help-block">:message</p>') !!}
				@break
			@default
				@break
		@endswitch
		</div>
	</div>
@endforeach

<div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input class="btn btn-primary" type="submit" value="     Upload     ">
        </div>
    </div>

</form>

@endsection