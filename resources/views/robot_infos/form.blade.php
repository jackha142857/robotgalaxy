
<div class="form-group {{ $errors->has('robot_id') ? 'has-error' : '' }}">
    <label for="robot_id" class="col-md-2 control-label">Robot</label>
    <div class="col-md-10">
        <select class="form-control" id="robot_id" name="robot_id" required="true">
        	    <option value="" style="display: none;" {{ old('robot_id', optional($robotInfo)->robot_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select robot</option>
        	@foreach ($Robots as $key => $Robot)
			    <option value="{{ $key }}" {{ old('robot_id', optional($robotInfo)->robot_id) == $key ? 'selected' : '' }}>
			    	{{ $Robot }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('robot_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('property_id') ? 'has-error' : '' }}">
    <label for="property_id" class="col-md-2 control-label">Property</label>
    <div class="col-md-10">
        <select class="form-control" id="property_id" name="property_id" required="true">
        	    <option value="" style="display: none;" {{ old('property_id', optional($robotInfo)->property_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select property</option>
        	@foreach ($Properties as $key => $Property)
			    <option value="{{ $key }}" {{ old('property_id', optional($robotInfo)->property_id) == $key ? 'selected' : '' }}>
			    	{{ $Property }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('property_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    <label for="content" class="col-md-2 control-label">Content</label>
    <div class="col-md-10">
        <input class="form-control" name="content" type="text" id="content" value="{{ old('content', optional($robotInfo)->content) }}" maxlength="255" placeholder="Enter content here...">
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>

