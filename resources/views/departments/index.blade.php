@extends('layouts.master')
@section('title', trans_title('departments'))
@section('breadcrumbs')
    {!! Breadcrumbs::render('departments') !!}
@stop
{{ Form::pageHeader('departments.create', 'departments') }}
@section('content')

    <div class="table-responsive">
        <table id="dynamic-table" class="table  table-bordered table-hover ">
            <thead>
                <tr>
                    <th>{{ trans('m.name_ar') }}</th>
                    <th>{{ trans('m.name_en') }}</th>
                    <th>{{ trans_vname('branch') }}</th>
                    <th>{{ trans('m.status') }}</th>
                    <th class="mw-20 w-20">{{ trans('m.operations') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($departments) && $departments->count() > 0)
                    @foreach ($departments as $item)
                        <tr>
                            <td>{{ $item->name_ar }}</td>
                            <td>{{ $item->name_en }}</td>
                            <td>{{ $item->branch->name_ar }}</td>
                            <td>{{ $item->getStatus() }}</td>
                            <td>
                                @include('partials.actions.departments')
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{ Form::tablePagination($departments) }}
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            dynamicDataTable('#dynamic-table');
        });
    </script>
@stop
