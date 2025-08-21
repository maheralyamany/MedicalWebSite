@extends('layouts.master')
@section('title', trans_title('xrays'))
@section('breadcrumbs')
    {!! Breadcrumbs::render('xrays') !!}
@stop
{{ Form::pageHeader('xrays.create', 'xrays') }}
@section('content')



    <div class="table-responsive">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover no-footer" width="100%">
            <thead>
                <tr>
                    <th>{{ trans('m.name_ar') }}</th>
                    <th>{{ trans('m.name_en') }}</th>
                    <th>{{ trans('m.xray_time') }}</th>
                    <th>{{ trans('m.price') }}</th>
                    <th>{{ trans('m.status') }}</th>
                    <th class="mw-20 w-20">{{ trans('m.operations') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($xrays) && $xrays->count() > 0)
                    @foreach ($xrays as $xray)
                        <tr>
                            <td>{{ $xray->name_ar }}</td>
                            <td>{{ $xray->name_en }}</td>
                            <td>{{ $xray->xray_time }}</td>
                            <td>{{ $xray->price }}</td>

                            <td>{{ $xray->getStatus() }}</td>
                            <td>
                                @include('partials.actions.xrays')
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
    {{ Form::tablePagination($xrays) }}
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            dynamicDataTable('#dynamic-table');
        });
    </script>
@stop
