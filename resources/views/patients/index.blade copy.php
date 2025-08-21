@extends('layouts.master')
@section('title', trans_title('patients'))
@section('breadcrumbs')
{!! Breadcrumbs::render('patients') !!}
@stop
{{ Form::pageHeader('patients.create', 'patients') }}
@section('content')
<div class="row">
    <div class="offset-md-3 col-sm-12 col-md-6  pt-1">
        <div class="row">
            <div class="form-group col">
                <input type="search" id="dynamic_table_filter" class="form-control form-control-sm d-inline-block" placeholder="{{ trans('m.search_patient_hint') }}">
            </div>
            <div class="form-group col-auto">
                <button id="dynamic_table_btn" class="btn btn-success btn-sm"> <i class="fa fa-search"></i>
                    {{ trans('m.search') }} </button>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="dynamic-table" class="table table-striped table-bordered table-hover no-footer" width="100%">
        <thead>
            <tr>
                <th>{{ trans('m.patientname') }}</th>
                <th>{{ trans('m.mobile') }}</th>
                <th>{{ trans('m.gender') }}</th>
                <th>{{ trans('m.age') }}</th>
                <th>{{ trans_vname('city') }}</th>
                <th>{{ trans('m.address') }}</th>
                <th>{{ trans('m.operations') }}</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($patients) && $patients->count() > 0)
            @foreach ($patients as $patient)
            <tr>
                <td>
                    <img src="{{ $patient->getPatientPhoto() }}" alt="maxSoft" class="avatar image-style p-1 mr-3 item-img col-aka d-md-inline">
                    {{ $patient->patientname }}</td>
                <td>{{ $patient->mobile }}</td>
                <td>{{ $patient->gender }}</td>
                <td>{{ $patient->age }}</td>
                <td>{{ $patient->city->name_ar }}</td>
                <td>{{ $patient->address }}</td>
                <td>
                    @include('partials.actions.patients')
                </td>
            </tr>
            @endforeach
            @else
            <tr class="odd">
                <td valign="top" colspan="7" class="dataTables_empty">{{ trans('m.filter_dataTables_empty') }}</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@stop
@section('scripts')
<script>
    $(function() {
        var dyDataTable = dynamicDataTable('#dynamic-table', {
            searching: false
            , ordering: false
            , paging: true
            , 
        , });
        $('#dynamic_table_filter').on('keyup click', function() {
            dyDataTable.search($('#dynamic_table_filter').val(), false, true).draw();
        });
        $('#dynamic_table_btn').on('click', function() {
            var filterVal = $('#dynamic_table_filter').val();
            if (filterVal && filterVal.length > 0) {
                $.ajax({
                    url: "{{ route('patients.search') }}"
                    , type: 'POST'
                    , dataType: "json"
                    , data: {
                        queryStr: filterVal
                    }
                    , success: function(data) {
                        console.info(data)
                        $('#patients_table_container').html(data.content);
                        dynamicDataTable('#dynamic-table', {
                            searching: false
                            , ordering: false
                        , });
                        $('div.card-footer').empty();
                        // dataTable.draw();
                    }
                });
            } else {
                var hh = `@component('patients.patients_table', ['patients' => $patients, 'isSearch' => false])@endcomponent`;
                $('#patients_table_container').html(hh);
                dynamicDataTable('#dynamic-table', {
                    searching: false
                    , ordering: false
                , });
            }
        });
    });
</script>
@stop