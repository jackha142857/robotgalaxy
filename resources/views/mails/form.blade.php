
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
    <label for="user_id" class="col-md-2 control-label">User</label>
    <div class="col-md-10">
        <select class="form-control" id="user_id" name="user_id">
        	    <option value="" style="display: none;" {{ old('user_id', optional($mail)->user_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select user</option>
        	@foreach ($Users as $key => $User)
			    <option value="{{ $key }}" {{ old('user_id', optional($mail)->user_id) == $key ? 'selected' : '' }}>
			    	{{ $User }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">Title</label>
    <div class="col-md-10">
        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($mail)->title) }}" minlength="1" maxlength="255" required="true" placeholder="Enter title here...">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    <label for="content" class="col-md-2 control-label">Content</label>
    <div class="col-md-10">
        <input class="form-control" name="content" type="text" id="content" value="{{ old('content', optional($mail)->content) }}" minlength="1" maxlength="255" required="true" placeholder="Enter content here...">
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('sender_user_id') ? 'has-error' : '' }}">
    <label for="sender_user_id" class="col-md-2 control-label">Sender User</label>
    <div class="col-md-10">
        <select class="form-control" id="sender_user_id" name="sender_user_id">
        	    <option value="" style="display: none;" {{ old('sender_user_id', optional($mail)->sender_user_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select sender user</option>
        	@foreach ($Users as $key => $User)
			    <option value="{{ $key }}" {{ old('sender_user_id', optional($mail)->sender_user_id) == $key ? 'selected' : '' }}>
			    	{{ $User }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('sender_user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
    <label for="state" class="col-md-2 control-label">State</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="state_1">
            	<input id="state_1" class="" name="state" type="checkbox" value="1" {{ old('state', optional($mail)->state) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
    </div>
</div>

