<div class="row">
    <div class="form-group has-float-label col-md-6">
        {{ Form::text('name_ar', isset($branch) ? $branch->name_ar : old('name_ar'), ['placeholder' => trans('m.name_ar'), 'class' => 'form-control ' . ($errors->has('name_ar') ? 'is-invalid' : '')]) }}
        <label for="name_ar">{{ trans('m.name_ar') }} <span class="astric">*</span></label>
        <small class="invalid-feedback">{{ $errors->has('name_ar') ? $errors->first('name_ar') : '' }}</small>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::text('name_en', isset($branch) ? $branch->name_en : old('name_en'), ['placeholder' => trans('m.name_en'), 'class' => 'form-control ' . ($errors->has('name_en') ? 'is-invalid' : '')]) }}
        <label for="name_en">{{ trans('m.name_en') }}</label>
        <small class="invalid-feedback">{{ $errors->has('name_en') ? $errors->first('name_en') : '' }}</small>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::text('address', isset($branch) ? $branch->address : old('address'), ['placeholder' => trans('m.address'), 'class' => 'form-control ' . ($errors->has('address') ? 'is-invalid' : '')]) }}
        <label for="address">{{ trans('m.address') }}</label>
        <small class="invalid-feedback">{{ $errors->has('address') ? $errors->first('address') : '' }}</small>
    </div>
    {{ Form::statusRadioGroup('status', isset($branch) ? $branch->status : old('status'), $errors) }}
    <div class="form-group has-float-label col-md-6">
        {{ Form::text('mobile', isset($branch) ? $branch->mobile : old('mobile'), ['placeholder' => trans('m.mobile'), 'class' => 'form-control ' . ($errors->has('mobile') ? 'is-invalid' : '')]) }}
        <label for="mobile"> {{ trans('m.mobile') }}</label>
        <small class="invalid-feedback">{{ $errors->has('mobile') ? $errors->first('mobile') : '' }}</small>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::email('email', isset($branch) ? $branch->email : old('email'), ['placeholder' => trans('m.email'), 'class' => 'form-control  ' . ($errors->has('email') ? 'is-invalid' : '')]) }}
        <label for="email">{{ trans('m.email') }} </label>
        <small class="invalid-feedback">{{ $errors->has('email') ? $errors->first('email') : '' }}</small>
    </div>
    {{ Form::fileGroup('logo', trans('m.logo'), $errors->has('logo') ? $errors->first('logo') : '', 'image/*', isset($branch) ? asset($branch->logo) : old('logo'), 'col-md-12') }}
    <div class="custom-group has-float-label col-md-12">
        <div class="form-control rounded-4 pt-4 h-auto">
            <div class="row pt-2">
                @foreach (trans('m.days') as $key => $value)
                    <?php
                    $checked =((is_array(old('branch_days')) && in_array($key, old('branch_days'))) || (isset($branch) && isset($branch->working_days) && is_array($branch->working_days) && in_array($key, $branch->working_days)))  ;
                    ?>
                    {{ Form::customCheckbox(
                        'branch_days[]',
                        $value ,
                        $key,
                        $checked,
                        [
                            'id' => 'branch_days-' . $key,
                            'disabled' => ($checked&&isset($branch)&& $branch->checkHasServiceTime($key)) ? 'disabled' : '',
                        ],
                        'col-md-3',
                    ) }}
                @endforeach
            </div>
        </div>
        <label>{{ trans('m.working_days') }}</label>
        <small class="invalid-feedback">{{ $errors->has('branch_days') ? $errors->first('branch_days') : '' }}</small>
    </div>
    @include('partials.portal.save_btn')
</div>
