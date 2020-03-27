
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}" hidden>
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($user)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}" hidden>
    <label for="email" class="col-md-2 control-label">Email</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" maxlength="255" required="true" placeholder="Enter email here...">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email_verified_at') ? 'has-error' : '' }}" hidden>
    <label for="email_verified_at" class="col-md-2 control-label">Email Verified At</label>
    <div class="col-md-10">
        <input class="form-control" name="email_verified_at" type="text" id="email_verified_at" value="{{ old('email_verified_at', optional($user)->email_verified_at) }}" placeholder="Enter email verified at here...">
        {!! $errors->first('email_verified_at', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    <label for="password" class="col-md-2 control-label">Password</label>
    <div class="col-md-10">
        <input class="form-control" name="password" type="password" id="password" value="" minlength="8" maxlength="255" required="true" placeholder="Enter password here...">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}" hidden>
    <label for="phone" class="col-md-2 control-label">Phone</label>
    <div class="col-md-10">
        <input class="form-control" name="phone" type="text" id="phone" value="{{ old('phone', optional($user)->phone) }}" maxlength="255" placeholder="Enter phone here...">
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}" hidden>
    <label for="address" class="col-md-2 control-label">Address</label>
    <div class="col-md-10">
        <input class="form-control" name="address" type="text" id="address" value="{{ old('address', optional($user)->address) }}" maxlength="255" placeholder="Enter address here...">
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}" hidden>
    <label for="dob" class="col-md-2 control-label">Dob</label>
    <div class="col-md-10">
        <input class="form-control" name="dob" type="text" id="dob" value="{{ old('dob', optional($user)->dob) }}" placeholder="Enter dob here...">
        {!! $errors->first('dob', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}" hidden>
    <label for="avatar" class="col-md-2 control-label">Avatar</label>
    <div class="col-md-10">
        <input class="form-control" name="avatar" type="text" id="avatar" value="{{ old('avatar', optional($user)->avatar) }}" maxlength="255">
        {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('privilege') ? 'has-error' : '' }}" hidden>
    <label for="privilege" class="col-md-2 control-label">Privilege</label>
    <div class="col-md-10">
        <input class="form-control" name="privilege" type="text" id="privilege" value="{{ old('privilege', optional($user)->privilege) }}" minlength="1" min="0" required="true" placeholder="Enter privilege here...">
        {!! $errors->first('privilege', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('remember_token') ? 'has-error' : '' }}" hidden>
    <label for="remember_token" class="col-md-2 control-label">Remember Token</label>
    <div class="col-md-10">
        <input class="form-control" name="remember_token" type="text" id="remember_token" value="{{ old('remember_token', optional($user)->remember_token) }}" maxlength="100" placeholder="Enter remember token here...">
        {!! $errors->first('remember_token', '<p class="help-block">:message</p>') !!}
    </div>
</div>

