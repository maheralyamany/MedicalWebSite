{{ Form::passwordGroup('password', trans('m.password'), $errors, (!isset($user))) }}
{{ Form::passwordGroup('confirm_password', trans('m.confirm_password'), $errors, (!isset($user))) }}



{{ Form::fileGroup('photo', trans('m.photo'), $errors->has('photo') ? $errors->first('photo') : '', 'image/*', isset($user) ? asset($user->photo)  : old('photo'), 'col-md-12') }}
