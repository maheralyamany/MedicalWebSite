<div class="row">
<div class="form-group has-float-label col-md-6">
    {{ Form::text('name_ar', isset($item) ? $item->name_ar : old('name_ar'), ['placeholder' => trans('m.name_ar'), 'class' => 'form-control ' . ($errors->has('name_ar') ? 'is-invalid' : '')]) }}
    <label for="name_ar">{{trans('m.name_ar') }}  <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('name_ar') ? $errors->first('name_ar') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::text('name_en', isset($item) ? $item->name_en : old('name_en'), ['placeholder' =>trans('m.name_en'), 'class' => 'form-control ' . ($errors->has('name_en') ? 'is-invalid' : '')]) }}
    <label for="name_en">{{trans('m.name_en') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('name_en') ? $errors->first('name_en') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::select('branch_id', $branches, (isset($item)) ? $item->branch_id : old('branch_id'), ['placeholder' => trans_choose('branch'),  'class' => 'form-control ' . ($errors->has('branch_id') ? 'is-invalid' : '') ]) }}
    <label for="branch_id">{{trans_vname('branch')}} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('branch_id') ? $errors->first('branch_id') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6">
    {{ Form::select('status', getItemStatusList(), isset($item) ? $item->status : old('status'), ['class' => 'form-control ' . ($errors->has('status') ? 'is-invalid' : '')]) }}
    <label for="status">{{ trans('m.status') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('status') ? $errors->first('status') : '' }}</small>
</div>
@include('partials.portal.save_btn')
</div>