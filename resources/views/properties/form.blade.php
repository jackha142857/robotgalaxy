
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($property)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('input_type_id') ? 'has-error' : '' }}">
    <label for="input_type_id" class="col-md-2 control-label">Input Type</label>
    <div class="col-md-10">
        <select class="form-control" id="input_type_id" name="input_type_id" required="true">
        	    <option value="" style="display: none;" {{ old('input_type_id', optional($property)->input_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select input type</option>
        	@foreach ($InputTypes as $key => $InputType)
			    <option value="{{ $key }}" {{ old('input_type_id', optional($property)->input_type_id) == $key ? 'selected' : '' }}>
			    	{{ $InputType }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('input_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <input class="form-control" name="description" type="text" id="description" value="{{ old('description', optional($property)->description) }}" maxlength="255">
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('order') ? 'has-error' : '' }}">
    <label for="order" class="col-md-2 control-label">Order</label>
    <div class="col-md-10">
    	<input class="form-control" type="number" id="order" name="order" min="0" max="100" value="{{ old('order', optional($property)->order) != 0 ? old('order', optional($property)->order) : 0 }}">
<!--         <input class="form-control" name="order" type="text" id="order" value="{{ old('order', optional($property)->order) }}" minlength="1" min="0" required="true" placeholder="Enter order here..."> -->
        {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('filter') ? 'has-error' : '' }}">
    <label for="filter" class="col-md-2 control-label">Filter Order</label>
    <div class="col-md-10">
    	<input class="form-control" type="number" id="filter" name="filter" min="0" max="100" value="{{ old('filter', optional($property)->filter) != 0 ? old('order', optional($property)->filter) : 0}}">
<!--         <input class="form-control" name="filter" type="text" id="filter" value="{{ old('filter', optional($property)->filter) }}" minlength="1" min="0" required="true" placeholder="Enter filter order here..."> -->
        {!! $errors->first('filter', '<p class="help-block">:message</p>') !!}
    </div>
</div>
