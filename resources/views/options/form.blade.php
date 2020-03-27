
<div class="form-group {{ $errors->has('option') ? 'has-error' : '' }}">
    <label for="option" class="col-md-2 control-label">Option</label>
    <div class="col-md-10">
        <input class="form-control" name="option" type="text" id="option" value="{{ old('option', optional($option)->option) }}" minlength="1" maxlength="255" required="true" placeholder="Enter option here...">
        {!! $errors->first('option', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('property_id') ? 'has-error' : '' }}">
    <label for="property_id" class="col-md-2 control-label">Property</label>
    <div class="col-md-10">
        <select class="form-control" id="property_id" name="property_id" required="true">
        	    <option value="" style="display: none;" {{ old('property_id', optional($option)->property_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select property</option>
        	@foreach ($Properties as $key => $Property)
			    <option value="{{ $key }}" {{ old('property_id', optional($option)->property_id) == $key ? 'selected' : '' }}>
			    	{{ $Property }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('property_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <input class="form-control" name="description" type="text" id="description" value="{{ old('description', optional($option)->description) }}" maxlength="255">
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

