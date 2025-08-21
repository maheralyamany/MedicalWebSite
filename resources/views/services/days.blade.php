<small class="invalid-feedback">{{ $errors->has('working_days') ? $errors->first('working_days') : '' }}</small>
@if (Session::has('working_day'))
    <small class="invalid-feedback"> {{ Session::get('working_day') }}</small>
@endif

@if (isset($times) && count($times) > 0)
    @foreach ($times as $index => $time)
        <tr class="timerow" role="{{ $time['day_name'] }}">
            <td style="border-top: 0px"> {{ $time['day_title'] }} </td>
            <td style="border-top: 0px">
                {{ Form::time('workingDay[' . $time['day_name'] . '][' . $time['order'] . '][from]', $time['start_time'], ['class' => 'form-control']) }}
            </td>
            <td style="border-top: 0px">
                {{ Form::time('workingDay[' . $time['day_name'] . '][' . $time['order'] . '][to]', $time['end_time'], ['class' => 'form-control']) }}
            </td>
            <td style="border-top: 0px" class="add_minus">
                <span class="btn btn-white btn-primary  btn-sm rounded-circle  m-1 addShiftTime"
                    data_day_en="{{ $time['day_name'] }}" data_day_ar="{{ $time['day_title'] }}"> <i
                        class="fa fa-plus fa-1x "></i></span>
                <span class="btn btn-white btn-danger  btn-sm rounded-circle m-1 removeEditTime"
                    data_day_en="{{ $time['day_name'] }}" data_day_ar="{{ $time['day_title'] }}"><i
                        class="fa fa-trash fa-1x "></i></span>
            </td>
        </tr>
    @endforeach
@endif
