<div class="form-group {{ $errors->has('oldPassword') ? 'has-error' : '' }}">
	<div class="row">
		<div class="col-md-3 "></div>
        <label for="oldPassword" class="col-md-3 control-label">Current Password</label>
        <div class="col-md-3">
            <input class="form-control" name="oldPassword" type="password" id="oldPassword" minlength="1" maxlength="255" required="true" placeholder="Enter current password here...">
            {!! $errors->first('oldPassword', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('newPassword') ? 'has-error' : '' }}">
	<div class="row">
		<div class="col-md-3 "></div>
        <label for="newPassword" class="col-md-3 control-label">New Password</label>
        <div class="col-md-3">
            <input class="form-control" name="newPassword" type="password" id="newPassword" minlength="8" maxlength="255" required="true" placeholder="Enter new password here...">
            {!! $errors->first('newPassword', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('rePassword') ? 'has-error' : '' }}">
	<div class="row">
		<div class="col-md-3 "></div>
        <label for="rePassword" class="col-md-3 control-label">Retype New Password</label>
        <div class="col-md-3">
            <input class="form-control" name="rePassword" type="password" id="rePassword" minlength="8" maxlength="255" required="true" placeholder="Retype new password here...">
            {!! $errors->first('rePassword', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
