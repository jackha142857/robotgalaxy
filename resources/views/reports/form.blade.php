
<div class="form-group {{ $errors->has('robot_id') ? 'has-error' : '' }}">
    <label for="robot_id" class="col-md-2 control-label">Robot</label>
    <div class="col-md-10">
        <select class="form-control" id="robot_id" name="robot_id" required="true">
        	    <option value="" style="display: none;" {{ old('robot_id', optional($report)->robot_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select robot</option>
        	@foreach ($Robots as $key => $Robot)
			    <option value="{{ $key }}" {{ old('robot_id', optional($report)->robot_id) == $key ? 'selected' : '' }}>
			    	{{ $Robot }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('robot_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
    <label for="user_id" class="col-md-2 control-label">User</label>
    <div class="col-md-10">
        <select class="form-control" id="user_id" name="user_id">
        	    <option value="" style="display: none;" {{ old('user_id', optional($report)->user_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select user</option>
        	@foreach ($Users as $key => $User)
			    <option value="{{ $key }}" {{ old('user_id', optional($report)->user_id) == $key ? 'selected' : '' }}>
			    	{{ $User }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
    <label for="comment" class="col-md-2 control-label">Comment</label>
    <div class="col-md-10">
        <input class="form-control" name="comment" type="text" id="comment" value="{{ old('comment', optional($report)->comment) }}" minlength="1" maxlength="255" required="true" placeholder="Enter comment here...">
        {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
    <label for="state" class="col-md-2 control-label">State</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="state_1">
            	<input id="state_1" class="" name="state" type="checkbox" value="1" {{ old('state', optional($report)->state) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
    </div>
</div>

