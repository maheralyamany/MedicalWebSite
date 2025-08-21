<div class="form-group has-float-label col-md-6">
    {{ Form::text('name_ar', isset($user) ? $user->name_ar : old('name_ar'), ['placeholder' => trans('m.name_ar'), 'class' => 'form-control  ' . ($errors->has('name_ar') ? 'is-invalid' : '')]) }}
    <label for="name_ar">{{ trans('m.name_ar') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('name_ar') ? $errors->first('name_ar') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::text('name_en', isset($user) ? $user->name_en : old('name_en'), ['placeholder' => trans('m.name_en'), 'class' => 'form-control  ' . ($errors->has('name_en') ? 'is-invalid' : '')]) }}
    <label for="name_en">{{ trans('m.name_en') }} </label>
    <small class="invalid-feedback">{{ $errors->has('name_en') ? $errors->first('name_en') : '' }}</small>
</div>
{{ Form::genderRadioGroup('gender', isset($user) ? $user->gender : old('gender'), $errors) }}

<div class="form-group has-float-label col-md-6">
    {{ Form::select('branch_id', $branches, isset($user) ? $user->branch_id : old('branch_id'), ['placeholder' => trans_choose('branch'), 'class' => 'form-control ' . ($errors->has('branch_id') ? 'is-invalid' : '')]) }}
    <label for="branch_id">{{ trans('m.branch.name') }}<span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('branch_id') ? $errors->first('branch_id') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::text('address', isset($user) ? $user->address : old('address'), ['placeholder' => trans('m.address'), 'class' => 'form-control  ' . ($errors->has('address') ? 'is-invalid' : '')]) }}
    <label for="address">{{ trans('m.address') }} </label>
    <small class="invalid-feedback">{{ $errors->has('address') ? $errors->first('address') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::text('mobile', isset($user) ? $user->mobile : old('mobile'), ['placeholder' => trans('m.phone'), 'class' => 'form-control  ' . ($errors->has('mobile') ? 'is-invalid' : '')]) }}
    <label for="mobile"> {{ trans('m.phone') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('mobile') ? $errors->first('mobile') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::email('email', isset($user) ? $user->email : old('email'), ['placeholder' => trans('m.email'), 'class' => 'form-control  ' . ($errors->has('email') ? 'is-invalid' : '')]) }}
    <label for="email">{{ trans('m.email') }} </label>
    <small class="invalid-feedback">{{ $errors->has('email') ? $errors->first('email') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::date('birth_date', isset($user) ? $user->birth_date : old('birth_date'), ['placeholder' => trans('m.birth_date'), 'class' => 'form-control  ' . ($errors->has('birth_date') ? 'is-invalid' : '')]) }}
    <label for="birth_date">{{ trans('m.birth_date') }} </label>
    <small class="invalid-feedback">{{ $errors->has('birth_date') ? $errors->first('birth_date') : '' }}</small>
</div>
{{ Form::statusRadioGroup('status', isset($user) ? $user->status : old('status'), $errors) }}

<div class="form-group has-float-label col-md-6">
    {{ Form::select('card_type_id', $cardTypes, isset($user) ? $user->card_type_id : old('card_type_id'), ['placeholder' => trans('m.choose_card_type'), 'class' => 'form-control   ' . ($errors->has('card_type_id') ? 'is-invalid' : '')]) }}
    <label for="card_type_id">{{ trans('m.card_type') }} </label>
    <small class="invalid-feedback">{{ $errors->has('card_type_id') ? $errors->first('card_type_id') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::text('id_card', isset($user) ? $user->id_card : old('id_card'), ['placeholder' => trans('m.id_card'), 'class' => 'form-control  ' . ($errors->has('id_card') ? 'is-invalid' : '')]) }}
    <label for="id_card"> {{ trans('m.id_card') }} </label>
    <small class="invalid-feedback">{{ $errors->has('id_card') ? $errors->first('id_card') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6 {{(!isset($isDoctor))?'':'d-none'}}">
    {{ Form::select('group_id', $usersType,(!isset($isDoctor))?( isset($user) ? $user->group_id : old('group_id')):3, ['placeholder' => trans('m.choose_user_group'), 'class' => 'form-control ' . ($errors->has('group_id') ? 'is-invalid' : '')]) }}
    <label for="group_id">{{ trans('m.user_group') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('group_id') ? $errors->first('group_id') : '' }}</small>
</div>
