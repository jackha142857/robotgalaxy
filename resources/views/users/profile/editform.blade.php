
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($user)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">Email</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="email" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" maxlength="255" required="true" placeholder="Enter email here...">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
    <label for="phone" class="col-md-2 control-label">Phone</label>
    <div class="col-md-10">
        <input class="form-control" name="phone" type="text" id="phone" value="{{ old('phone', optional($user)->phone) }}" maxlength="255" placeholder="Enter phone here...">
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
    <label for="address" class="col-md-2 control-label">Address</label>
    <div class="col-md-10">
        <input class="form-control" name="address" type="text" id="address" value="{{ old('address', optional($user)->address) }}" maxlength="255" placeholder="Enter address here...">
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
    <label for="dob" class="col-md-12 control-label">Date of birth, format: day/month/year without leading zero</label>
    <div class="col-md-10">
        <input class="form-control" name="dob" type="text" id="dob" value="{{ old('dob', optional($user)->dob) }}" placeholder="Enter dob here... ex: 13/12/1991, 1/3/2012">
        {!! $errors->first('dob', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
    <label for="avatar" class="col-md-2 control-label">Avatar</label>
    <div class="col-md-10">
        <input class="form-control" name="avatar" type="text" id="avatar" value="{{ old('avatar', optional($user)->avatar) }}" placeholder="Link to your avatar" maxlength="255">
        {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
    </div>
</div>



