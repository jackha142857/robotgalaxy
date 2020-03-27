
<div class="form-group {{ $errors->has('robot_id') ? 'has-error' : '' }}">
    <label for="robot_id" class="col-md-2 control-label">Robot</label>
    <div class="col-md-10">
        <select class="form-control" id="robot_id" name="robot_id" required="true">
        	    <option value="" style="display: none;" {{ old('robot_id', optional($comment)->robot_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select robot</option>
        	@foreach ($Robots as $key => $Robot)
			    <option value="{{ $key }}" {{ old('robot_id', optional($comment)->robot_id) == $key ? 'selected' : '' }}>
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
        	    <option value="" style="display: none;" {{ old('user_id', optional($comment)->user_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select user</option>
        	@foreach ($Users as $key => $User)
			    <option value="{{ $key }}" {{ old('user_id', optional($comment)->user_id) == $key ? 'selected' : '' }}>
			    	{{ $User }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('comment_id') ? 'has-error' : '' }}">
    <label for="comment_id" class="col-md-2 control-label">Comment</label>
    <div class="col-md-10">
        <select class="form-control" id="comment_id" name="comment_id">
        	    <option value="" style="display: none;" {{ old('comment_id', optional($comment)->comment_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select comment</option>
        	@foreach ($ParentComments as $key => $ParentComment)
			    <option value="{{ $key }}" {{ old('comment_id', optional($comment)->comment_id) == $key ? 'selected' : '' }}>
			    	{{ $ParentComment }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('comment_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
    <label for="comment" class="col-md-2 control-label">Comment</label>
    <div class="col-md-10">
        <textarea class="form-control" name="comment" cols="50" rows="10" id="comment" required="true" placeholder="Enter comment here...">{{ old('comment', optional($comment)->comment) }}</textarea>
        {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
    </div>
</div>

