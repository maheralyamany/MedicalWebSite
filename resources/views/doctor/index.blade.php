@extends('layouts.master')

@section('title', trans_title('doctor'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('doctor') !!}
@stop
{{ Form::pageHeader('doctor.add', 'doctor') }}
@section('content')



    <div class="table-responsive">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover no-footer" width="100%">
            <thead>
                <tr>

                    <th>{{ trans('m.name_ar') }}</th>
                    <th>{{ trans('m.name_en') }}</th>
                    <th>{{ trans_vname('nickname') }}</th>
                    <th>{{ trans_vname('specification') }}</th>
                    <th>{{ trans_vname('nationality') }}</th>
                    <th>{{ trans('m.consulting_price') }}</th>
                    <th>{{ trans('m.salary') }}</th>
                    <th>{{ trans('m.status') }}</th>
                    <th class="mw-20 w-20">{{ trans('m.operations') }}</th>

                </tr>
            </thead>
            <tbody>
                @if (isset($doctors) && $doctors->count() > 0)
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->user->name_ar }}</td>
                            <td>{{ $doctor->user->name_en }}</td>
                            <td>{{ $doctor->nickname->getTransName() }}</td>
                            <td>{{ $doctor->specification->getTransName() }}</td>
                            <td>{{ $doctor->nationality->getTransName() }}</td>
                            <td>{{ $doctor->consulting_price }}</td>
                            <td>{{ $doctor->salary }}</td>
                            <td>{{ $doctor->user->getStatus() }}</td>
                            <td>
                                @include('partials.actions.doctor')
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{ Form::tablePagination($doctors) }}
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            dynamicDataTable('#dynamic-table');
        });
    </script>
@stop
