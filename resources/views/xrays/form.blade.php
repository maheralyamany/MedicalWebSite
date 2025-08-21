<div class="row">
<div class="form-group has-float-label col-md-6">
    {{ Form::text('name_ar', isset($xray) ? $xray->name_ar : old('name_ar'), ['placeholder' => trans('m.name_ar'), 'class' => 'form-control  ' . ($errors->has('name_ar') ? 'is-invalid' : '')]) }}
    <label for="name_ar">{{ trans('m.name_ar') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('name_ar') ? $errors->first('name_ar') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::text('name_en', isset($xray) ? $xray->name_en : old('name_en'), ['placeholder' => trans('m.name_en'), 'class' => 'form-control  ' . ($errors->has('name_en') ? 'is-invalid' : '')]) }}
    <label for="name_en">{{ trans('m.name_en') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('name_en') ? $errors->first('name_en') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::text('xray_time', isset($xray) ? $xray->xray_time : old('xray_time'), ['placeholder' => trans('m.time_placeholder'), 'class' => 'form-control  ' . ($errors->has('xray_time') ? 'is-invalid' : '')]) }}
    <label for="xray_time">{{ trans('m.xray_time') }} </label>
    <small class="invalid-feedback">{{ $errors->has('xray_time') ? $errors->first('xray_time') : '' }}</small>
</div>

<div class="form-group has-float-label col-md-6">
    {{ Form::number('price', isset($xray) ? $xray->price : old('price'), ['placeholder' => '0', 'class' => 'form-control ' . ($errors->has('price') ? 'is-invalid' : '')]) }}
    <label for="price">{{ trans('m.price') }} <span class="astric">*</span></label>
    <small
        class="text-danger">{{ $errors->has('price') ? $errors->first('price') : '' }}</small>
</div>
{{ Form::statusRadioGroup('status', isset($xray) ? $xray->status : old('status'), $errors) }}



@include('partials.portal.save_btn')
</div>