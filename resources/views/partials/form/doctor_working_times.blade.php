@stack('workingDay_input_start')
<?php
$times = isset($service) && isset($service->serviceTimes) ? $service->serviceTimes : [];
$tableId = 'working_hours' . $service->id;
?>
<div class="{{ $col }}">
    <div class="page-content">
        <div class="col-md-12">
            <div class="page-header">
                <h1><i class="menu-icon fa fa-clock-o"></i> {{ trans('m.doctor_service_time') }}
                    <strong>{{ $service->service_name }}</strong>
                </h1>
            </div>
        </div>
    </div>
    <table class="table table-bordered" name="working_hours" id="{{ $tableId }}">
        <thead>
            <tr>
                <th scope="col" style="width: 10%;">{{ trans('m.day') }}</th>
                <th scope="col"><span class="ml-3">{{ trans('m.from') }}</span>
                </th>
                <th scope="col"><span class="ml-3">{{ trans('m.to') }}</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @if (count($times) > 0)
                @foreach ($times as $time)
                    <?php
                    $time = (object) $time;
                    $day_title = trans('m.days.' . $time->day_name); ?>
                    <tr class="timerow" role="{{ $time->day_name }}">
                        <td style="border-top: 0px">
                            <?php $chId = 'workingDay[' . $service->id . '][' . $time->day_name . '][' . $time->order . '][select]'; ?>
                            <input type="checkbox" class="form-check-input" id="{{ $chId }}"
                                value="1"> <label class="non-float form-check-label"
                                for="{{ $chId }}"> {{ $day_title }}</label>


                        <td style="border-top: 0px" >
                            {{ Form::time('workingDay[' . $service->id . '][' . $time->day_name . '][' . $time->order . '][from]', $time->start_time, ['class' => 'form-control','readOnly'=>'readOnly']) }}
                        </td>
                        <td style="border-top: 0px" >
                            {{ Form::time('workingDay[' . $service->id . '][' . $time->day_name . '][' . $time->order . '][to]', $time->end_time, ['class' => 'form-control','readOnly'=>'readOnly']) }}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <small class="invalid-feedback">{{ $errors->has('workingDay') ? $errors->first('workingDay') : '' }}</small>
</div>
<script>
    $(function() {});
</script>
@stack('workingDay_input_end')
