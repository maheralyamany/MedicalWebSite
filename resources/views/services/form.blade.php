<div class="row">
<div class="form-group has-float-label  col-md-12">
    {{ Form::text('service_name', isset($item) ? $item->service_name : old('service_name'), ['placeholder' => trans('m.item_name'), 'class' => 'form-control ' . ($errors->has('service_name') ? 'is-invalid' : '')]) }}
    <label for="service_name">{{ trans('m.item_name') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('service_name') ? $errors->first('service_name') : '' }}</small>
</div>
<div class="form-group has-float-label  col-md-6">
    {{ Form::select('department_id', $departments, isset($item) ? $item->department_id : old('department_id'), ['placeholder' => trans_choose('departments'), 'class' => 'form-control ' . ($errors->has('department_id') ? 'is-invalid' : '')]) }}
    <label for="department_id">{{ trans_vname('departments') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('department_id') ? $errors->first('department_id') : '' }}</small>
</div>
<div class="form-group has-float-label  col-md-6">
    {{ Form::select('status', getItemStatusList(), isset($item) ? $item->status : old('status'), ['class' => 'form-control ' . ($errors->has('status') ? 'is-invalid' : '')]) }}
    <label for="status">{{ trans('m.status') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('status') ? $errors->first('status') : '' }}</small>
</div>
<div class="form-group has-float-label  col-md-6">
    {{ Form::select('has_price', getServiceTypeList(), isset($item) ? $item->has_price : old('has_price'), ['class' => 'form-control ' . ($errors->has('has_price') ? 'is-invalid' : '')]) }}
    <label for="has_price">{{ trans('m.service_type') }} <span class="astric">*</span></label>
    <small class="invalid-feedback">{{ $errors->has('has_price') ? $errors->first('has_price') : '' }}</small>
</div>
<div class="form-group has-float-label col-md-6 d-none" id="price_group">
    {{ Form::number('price', isset($item) ? $item->price : old('price'), ['placeholder' => trans('m.price'), 'class' => 'form-control ' . ($errors->has('price') ? 'is-invalid' : '')]) }}
    <label for="price">{{ trans('m.price') }} <span class="astric">*</span></label>
    <small class="text-danger d-block">{{ $errors->has('price') ? $errors->first('price') : '' }}</small>
</div>
{{ Form::workingTimesGroup(isset($times) ? $times : [], trans('m.service_times'),  $errors, isset($item) ? $item->id : 0) }}
<div class="form-group col-sm-12 submit">
    {{ Form::submit(null, ['class' => 'btn  btn-primary btn-sm', 'id' => 'postWorkingHourse']) }}
</div>
</div>
@section('scripts')
    <script>
        var price = "{{ isset($item) ? $item->price : old('price') }}";
        if (!price)
            price = '0';
        $(function() {
            $('select[name="has_price"]').on('change', function() {
                $('input[name="price"]').val(price);
                if ($(this).val() == '1')
                    $('#price_group').removeClass('d-none')
                else
                    $('#price_group').addClass('d-none')
            }).trigger('change');

            $("#postWorkingHourse").on('click', function(e) {
                e.preventDefault();
                var $emptyInputs = $('table[name="working_hours"] input[type="time"]').filter(function() {
                    return $(this).val() == "";
                });
                if ($emptyInputs.length > 0) {
                    $.each($emptyInputs, (j, k) => {
                        $(k).parents().closest('tr[role]').remove();
                    });
                }
                $(this.form).submit();
            });
        });
    </script>
@stop
