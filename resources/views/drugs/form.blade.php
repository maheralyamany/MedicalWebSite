<div class="row">
<div class="form-group has-float-label col-md-6">
    {{ Form::text('name_ar', isset($drug) ? $drug->name_ar : old('name_ar'), ['placeholder' => trans('m.name_ar'), 'class' => 'form-control  ' . ($errors->has('name_ar') ? 'is-invalid' : '')]) }}
    <label for="name_ar">{{ trans('m.name_ar') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('name_ar') ? $errors->first('name_ar') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::text('name_en', isset($drug) ? $drug->name_en : old('name_en'), ['placeholder' => trans('m.name_en'), 'class' => 'form-control  ' . ($errors->has('name_en') ? 'is-invalid' : '')]) }}
    <label for="name_en">{{ trans('m.name_en') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('name_en') ? $errors->first('name_en') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::text('description', isset($drug) ? $drug->description : old('description'), ['placeholder' => trans('m.description'), 'class' => 'form-control  ' . ($errors->has('description') ? 'is-invalid' : '')]) }}
    <label for="description">{{ trans('m.description') }} </label>
    <small class="invalid-feedback">{{ $errors->has('description') ? $errors->first('description') : '' }}</small>
</div>

<div class="form-group has-float-label col-md-6">
    {{ Form::select('type_id', $drugTypes, isset($drug) ? $drug->type_id : old('type_id'), [
        'class' => 'form-control ' . ($errors->has('type_id') ? 'is-invalid' : ''),
    ]) }}
    <label for="type_id">{{ trans('m.drug_type') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('type_id') ? $errors->first('type_id') : '' }}</small>
</div>
{{ Form::statusRadioGroup('status', isset($drug) ? $drug->status : old('status'), $errors) }}



@include('partials.portal.save_btn')
</div>