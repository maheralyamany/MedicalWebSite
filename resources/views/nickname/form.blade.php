<div class="row">
<div class="form-group has-float-label col-md-12">
    {{ Form::text('name_ar', old('name_ar'), ['placeholder' => trans('m.name_ar'),  'class' => 'form-control ' . ($errors->has('name_ar') ? 'is-invalid' : '') ]) }}
    <label for="name_ar">{{trans('m.name_ar') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('name_ar') ? $errors->first('name_ar') : '' }}</small>
</div>

<div class="form-group has-float-label col-md-12">
    {{ Form::text('name_en', old('name_en'), ['placeholder' => trans('m.name_en'),  'class' => 'form-control ' . ($errors->has('name_en') ? 'is-invalid' : '') ]) }}
    <label for="name_en">{{trans('m.name_en') }}  <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('name_en') ? $errors->first('name_en') : '' }}</small>
</div>

@include('partials.portal.save_btn')
</div>
