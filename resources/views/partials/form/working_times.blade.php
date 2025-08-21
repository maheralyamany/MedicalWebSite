@stack('workingDay_input_start')
<?php
$times = isset($times) ? $times : [];
$tableId = 'working_hours' . $service_id;
$doctor_form = key_exists('doctor_form', $attributes);
?>
<div class="{{ $col }}">
    <div class="page-content">
        <div class="col-md-12">
            <div class="page-header">
                <h1><i class="menu-icon fa fa-clock-o"></i> {{ $title }}
                    @if (key_exists('service_name', $attributes))
                        <strong>{{ $attributes['service_name'] }}</strong>
                    @endif
                </h1>
            </div>
        </div>
    </div>
    <table class="table table-bordered" name="working_hours" id="{{ $tableId }}">
        <thead>
            <tr>
                <th scope="col" style="width: 10%;">{{ trans('m.day') }}</th>
                <th scope="col"><span class="ml-3">{{ trans('m.from') }}</span>
                    @if (!$doctor_form)
                        {{ Form::time('txt_time_from', '', ['class' => 'form-control form-control-sm inline w-40 ml-2', 'id' => 'txt_time_from']) }}
                        <button class="btn btn-white btn-primary rounded-5 table-btn" id="btn_time_from"> <i
                                class="fas fa-calendar-plus"></i></button>
                    @endif

                </th>
                <th scope="col"><span class="ml-3">{{ trans('m.to') }}</span>

                    @if (!$doctor_form)
                        {{ Form::time('txt_time_to', '', ['class' => 'form-control form-control-sm inline w-40 ml-2', 'id' => 'txt_time_to']) }}
                        <button class="btn btn-white btn-primary rounded-5 table-btn" id="btn_time_to"> <i
                                class="fas fa-calendar-plus"></i></button>
                    @endif


                </th>
                <th scope="col" style="width:13%;"></th>
            </tr>
        </thead>
        <tbody>
            @if (count($times) > 0)
                @foreach ($times as $time)
                    <?php
                    $time = (object) $time;
                    $day_title = trans('m.days.' . $time->day_name); ?>
                    <tr class="timerow" role="{{ $time->day_name }}">
                        <td style="border-top: 0px"> {{ $day_title }} </td>
                        <td style="border-top: 0px">
                            {{ Form::time('workingDay[' . $service_id . '][' . $time->day_name . '][' . $time->order . '][from]', $time->start_time, ['class' => 'form-control', 'role' => 'from']) }}
                        </td>
                        <td style="border-top: 0px">
                            {{ Form::time('workingDay[' . $service_id . '][' . $time->day_name . '][' . $time->order . '][to]', $time->end_time, ['class' => 'form-control', 'role' => 'to']) }}
                        </td>
                        <td style="border-top: 0px" class="add_minus">
                            <span class="btn btn-white btn-primary  btn-sm rounded-circle  m-1 addShiftTime"
                                data_day_en="{{ $time->day_name }}" data_day_ar="{{ $day_title }}"> <i
                                    class="fa fa-plus fa-1x "></i></span>
                            <span class="btn btn-white btn-danger  btn-sm rounded-circle m-1 removeEditTime"
                                data_day_en="{{ $time->day_name }}" data_day_ar="{{ $day_title }}"><i
                                    class="fa fa-trash fa-1x "></i></span>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <small class="invalid-feedback">{{ $errors->has('workingDay') ? $errors->first('workingDay') : '' }}</small>
</div>
<script>
    $(function() {
        var service_id = "{{ $service_id }}";
        $('#btn_time_from').on('click', function(e) {
            e.preventDefault();
            var tim = $('#txt_time_from').val();
            $(this).parents().closest('table').find('input[type="time"][role="from"]').val(tim);
        });
        $('#btn_time_to').on('click', function(e) {
            e.preventDefault();
            var tim = $('#txt_time_to').val();
            $(this).parents().closest('table').find('input[type="time"][role="to"]').val(tim);
        });
        $(document).on('click', '.addShiftTime', function(e) {
            e.preventDefault();
            var $eml = $(this);
            //let counter = Number.parseInt($(this).attr('data_counter'));
            let day_ar = $eml.attr('data_day_ar');
            let day_en = $eml.attr('data_day_en');
            var rows = $('#{{ $tableId }} tr[role="' + day_en + '"]');
            var curCounter = rows.length;
            curCounter = (curCounter + 1).toString();
            var dayKey = day_en + curCounter;
            var $content = $(` <tr class="timerow order` + dayKey + `" role="` + day_en +
                `">  <td style="border-top: 0px"> ` + day_ar +
                ` </td> <td style="border-top: 0px"> {{ Form::time('workingDay[`+service_id+`][` + day_en + `][` + curCounter + `][from]', '', ['class' => 'form-control', 'role' => 'from']) }}</td> <td style="border-top: 0px">{{ Form::time('workingDay[`+service_id+`][` + day_en + `][` + curCounter + `][to]', '', ['class' => 'form-control', 'role' => 'to']) }}</td> <td style="border-top: 0px"  class="add_minus"><span class="btn btn-white btn-primary  btn-sm rounded-circle m-1 addShiftTime" data_day_en="` +
                day_en + `" data_day_ar="` + day_ar +
                `"><i     class="fa fa-plus fa-1x "> </i></span><span class="btn btn-white btn-danger  btn-sm rounded-circle m-1 removeShiftTime" data_day_en="` +
                day_en + `" data_day_ar="` + day_ar +
                `" ><i   class="fa fa-minus fa-1x "> </i></span> </td> </tr>`);
            rows.last().after($content);
            $content.find('input[type="time"]').first().focus();
        });
        $(document).on('click', '.removeShiftTime', function(e) {
            e.preventDefault();
            $(this).parents().closest('tr[role]').remove();
        });
        $(document).on('click', '.removeEditTime', function(e) {
            e.preventDefault();
            $(this).parents().closest('tr[role]').find('input[type="time"]').removeAttr('value');
        });

    });
</script>
@stack('workingDay_input_end')
