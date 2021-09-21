<div class="form-group {{ $errors->has('userID') ? 'has-error' : ''}}">
    <label for="userID" class="control-label">{{ 'Userid' }}</label>
    <input class="form-control" name="userID" type="number" id="userID" value="{{ isset($user->userID) ? $user->userID : ''}}" >
    {!! $errors->first('userID', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($user->name) ? $user->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
    <label for="username" class="control-label">{{ 'Username' }}</label>
    <input class="form-control" name="username" type="text" id="username" value="{{ isset($user->username) ? $user->username : ''}}" >
    {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Address' }}</label>
    <input class="form-control" name="address" type="text" id="address" value="{{ isset($user->address) ? $user->address : ''}}" >
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('userBirthday') ? 'has-error' : ''}}">
    <label for="userBirthday" class="control-label">{{ 'Userbirthday' }}</label>
    <input class="form-control" name="userBirthday" type="date" id="userBirthday" value="{{ isset($user->userBirthday) ? $user->userBirthday : ''}}" >
    {!! $errors->first('userBirthday', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="control-label">{{ 'Phone' }}</label>
    <input class="form-control" name="phone" type="text" id="phone" value="{{ isset($user->phone) ? $user->phone : ''}}" >
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
    <label for="gender" class="control-label">{{ 'Gender' }}</label>
    <input class="form-control" name="gender" type="number" id="gender" value="{{ isset($user->gender) ? $user->gender : ''}}" >
    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="image" type="text" id="image" value="{{ isset($user->image) ? $user->image : ''}}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('userTypeID') ? 'has-error' : ''}}">
    <label for="userTypeID" class="control-label">{{ 'Usertypeid' }}</label>
    <input class="form-control" name="userTypeID" type="number" id="userTypeID" value="{{ isset($user->userTypeID) ? $user->userTypeID : ''}}" >
    {!! $errors->first('userTypeID', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($user->email) ? $user->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="control-label">{{ 'Password' }}</label>
    <input class="form-control" name="password" type="text" id="password" value="{{ isset($user->password) ? $user->password : ''}}" >
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
