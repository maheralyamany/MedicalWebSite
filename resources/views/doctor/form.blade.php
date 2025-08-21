<?php
if (isset($doctor)) {
    $user = $doctor->user;
}
$isDoctor = 1;
?>
<div class="row">
    @include('user.form_input')
    <div class="form-group has-float-label col-md-6">
        {{ Form::select('nickname_id', $nicknames, isset($doctor) ? $doctor->nickname_id : old('nickname_id'), ['placeholder' => trans_choose('nickname'), 'class' => 'form-control ' . ($errors->has('nickname_id') ? 'is-invalid' : '')]) }}
        <label for="nickname_id">{{ trans('m.nickname.doctor_name') }} <span class="astric">*</span></label>
        <small class="invalid-feedback">{{ $errors->has('nickname_id') ? $errors->first('nickname_id') : '' }}</small>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::select('specification_id', $specifications, isset($doctor) ? $doctor->specification_id : old('specification_id'), ['placeholder' => trans_choose('specification'), 'class' => 'form-control ' . ($errors->has('specification_id') ? 'is-invalid' : '')]) }}
        <label for="specification_id">{{ trans_vname('specification') }} <span class="astric">*</span></label>
        <small
            class="text-danger">{{ $errors->has('specification_id') ? $errors->first('specification_id') : '' }}</small>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::select('nationality_id', $nationalities, isset($doctor) ? $doctor->nationality_id : old('nationality_id'), ['placeholder' => trans_choose('nationality'), 'class' => 'form-control ' . ($errors->has('nationality_id') ? 'is-invalid' : '')]) }}
        <label for="nationality_id">{{ trans_vname('nationality') }} <span class="astric">*</span></label>
        <small class="invalid-feedback">{{ $errors->has('nationality_id') ? $errors->first('nationality_id') : '' }}</small>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::number('consulting_price', isset($doctor) ? $doctor->consulting_price : old('consulting_price'), ['placeholder' => '0', 'class' => 'form-control ' . ($errors->has('consulting_price') ? 'is-invalid' : '')]) }}
        <label for="consulting_price">{{ trans('m.consulting_price') }} <span class="astric">*</span></label>
        <small
            class="text-danger">{{ $errors->has('consulting_price') ? $errors->first('consulting_price') : '' }}</small>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::number('salary', isset($doctor) ? $doctor->salary : old('salary'), ['placeholder' => '0', 'class' => 'form-control ' . ($errors->has('salary') ? 'is-invalid' : '')]) }}
        <label for="salary">{{ trans('m.salary') }} </label>
        <small class="invalid-feedback">{{ $errors->has('salary') ? $errors->first('salary') : '' }}</small>
    </div>
    @include('user.form_input_footer')
    @if (isset($services) && $services->count() > 0)
        <div class="custom-group has-float-label col-md-12">
            <div class="form-control rounded-4 pt-4 h-auto">
                <div class="row pt-2">
                    @foreach ($services as $service)
                        <?php
                        $checked =((is_array(old('services')) && in_array($service->id, old('services'))) || in_array($service->id, $doctorServices))  ;
                        ?>
                        {{ Form::customCheckbox(
                            'services[]',
                            $service->service_name ,
                            $service->id,
                            $checked,
                            [
                                'id' => 'services-' . $service->id,
                                'disabled' => (count($service->appointments) > 0 && !$checked) ? 'disabled' : '',
                            ],
                            'col-md-3',
                        ) }}
                    @endforeach
                </div>
            </div>
            <label>{{ trans('m.doctor_services') }}</label>
            <small class="invalid-feedback">{{ $errors->has('services') ? $errors->first('services') : '' }}</small>
        </div>
    @endif
    @include('partials.portal.save_btn')
</div>
