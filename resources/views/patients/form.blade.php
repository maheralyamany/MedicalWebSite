<div class="row">
    <input type="text" style="display: none;" class="form-control" value="{{ isset($patient) ? $patient->id : 0 }}"
        name="id">
    <div class="form-group has-float-label col-md-6">
        {{ Form::text('patientname', isset($patient) ? $patient->patientname : old('patientname'), [
            'placeholder' => trans('m.patientname'),
            'class' => 'form-control ',
        ]) }}
        <label for="patientname">{{ trans('m.patientname') }} <span class="astric">*</span></label>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::text('mobile', isset($patient) ? $patient->mobile : old('mobile'), [
            'placeholder' => trans('m.mobile'),
            'class' => 'form-control ',
        ]) }}
        <label for="mobile"> {{ trans('m.mobile') }}</label>
    </div>
    {{ Form::genderRadioGroup('gender', isset($patient) ? $patient->gender : old('gender'), $errors) }}
    <div class="form-group has-float-label col-md-6">
        {{ Form::select('city_id', getCitiesList(), isset($patient) ? $patient->city_id : old('city_id'), [
            'class' => 'form-control ',
        ]) }}
        <label for="city_id">{{ trans_vname('city') }} <span class="astric">*</span></label>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::text('address', isset($patient) ? $patient->address : old('address'), [
            'placeholder' => trans('m.address'),
            'class' => 'form-control ',
        ]) }}
        <label for="address">{{ trans('m.address') }}</label>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::email('email', isset($patient) ? $patient->email : old('email'), [
            'placeholder' => trans('m.email'),
            'class' => 'form-control  ',
        ]) }}
        <label for="email">{{ trans('m.email') }} </label>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::number('age', getInputValue(isset($patient) ? $patient->age : old('age'), 0), [
            'class' => 'form-control text-box ',
        ]) }}
        <label for="age">{{ trans('m.age') }} </label>
    </div>
    <div class="form-group has-float-label col-md-6">
        {{ Form::select('bloodgroup', getBloodGroupList(), isset($patient) ? $patient->bloodgroup : old('bloodgroup'), [
            'placeholder' => trans('m.choose_bloodgroup'),
            'class' => 'form-control ',
        ]) }}
        <label for="bloodgroup">{{ trans('m.bloodgroup') }} </label>
    </div>
    @if (!isset($patient))
        <div class="form-group has-float-label col-md-6">
            <select name="service_id" placeholder="{{ trans_choose('services') }}" class="form-control">
                <option value>{{ trans_choose('services') }}</option>
                @foreach ($services as $ser)
                    <option value="{{ $ser->id }}" @if (old('service_id') == $ser->id) selected="selected" @endif>
                        {{ $ser->service_name }}</option>
                @endforeach
            </select>
            <label for="service_id">{{ trans_vname('services') }} </label>
            <input type="hidden" id="ser_has_price" name="ser_has_price" />
        </div>
        <div class="form-group has-float-label col-md-6 d-none" id="doctor_group">
            {{ Form::select('doctor_id', [], old('doctor_id'), [
                'placeholder' => trans_choose('doctor'),
                'class' => 'form-control ',
            ]) }}
            <label for="doctor_id">{{ trans_vname('doctor') }} </label>
        </div>
        <div class="form-group has-float-label col-md-6 d-none" id="price_group">
            {{ Form::number('price', old('price'), ['placeholder' => trans('m.price'), 'class' => 'form-control']) }}
            <label for="price">{{ trans('m.price') }} <span class="astric">*</span></label>
        </div>
    @endif
    {{ Form::fileGroup('photo', trans('m.photo'), $errors->has('photo') ? $errors->first('photo') : '', 'image/*', isset($patient) ? $patient->photo : old('photo')) }}
    @include('partials.portal.save_btn')
</div>
@include('includes.form_validation')
@section('scripts')
    <script>
        var services = <?= $services ?>;
        var validationRules = <?= getPartialValidateRules() ?>;
        console.info(services);
    </script>
    <script>
        if ($('select[name="service_id"]').length > 0) {
            $('select[name="service_id"]').on('change', function() {
                var price = 0;
                $('select[name="doctor_id"]').find('option:not(:first)').remove();
                $('#doctor_group').addClass('d-none');
                $('#price_group').addClass('d-none');
                $('#ser_has_price').val('0');
                if ($(this).val()) {
                    var id = parseInt($(this).val());
                    var ser = services.filter((s) => {
                        return s.id == id
                    });
                    if (ser.length > 0) {
                        ser = ser[0];
                        if (ser.has_price) {
                            price = ser.price;
                            $('#price_group').removeClass('d-none');
                            $('#ser_has_price').val('1');
                        }
                        if (ser.doctors.length > 0) {
                            var html = '';
                            ser.doctors.forEach(doc => {
                                html += ` <option value="` + doc.id + `" >` + doc.user.name_ar +
                                    `</option> `;
                            });
                            $('select[name="doctor_id"]').append(html);
                            $('#doctor_group').removeClass('d-none');
                        }
                    }
                }
                $('input[name="price"]').val(price);
            }).trigger('change');
            validationRules.rules['service_id'] = {
                required: true
            };
            validationRules.rules['doctor_id'] = {
                required: true
            };
        }

        validateForm('save_patient_form', validationRules, (form) => {
            var url = form.attr("action");
            var formData = new FormData(form[0]);
            console.info(formData);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.status == false) {
                        ShowToastrError(data.msg);
                    } else {
                        ShowToastrSuccess(data.msg);
                        // return redirect the provider to phone activate
                        window.location.href = "{{ route('patients.index') }}";
                    }
                },
                error: function(reject) {
                    console.info(reject.responseText);
                    ShowSwError(reject.responseText);
                }
            });
        });
    </script>
@endsection
