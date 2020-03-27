
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">Email</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ old('email', optional($subscribe)->email) }}" minlength="1" maxlength="255" required="true" placeholder="Enter email here...">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('subscribe') ? 'has-error' : '' }}">
    <label for="subscribe" class="col-md-2 control-label">Subscribe</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="subscribe_1">
            	<input id="subscribe_1" class="" name="subscribe" type="checkbox" value="1" {{ old('subscribe', optional($subscribe)->subscribe) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('subscribe', '<p class="help-block">:message</p>') !!}
    </div>
</div>

