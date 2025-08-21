@extends('layouts.master')
@section('title', trans_title('specification'))
@section('breadcrumbs')
    {!! Breadcrumbs::render('specification') !!}
@stop
{{ Form::pageHeader('specification.add', 'specification') }}
@section('content')


    <div class="table-responsive">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover no-footer" width="100%">
            <thead>
                <tr>
                    <th>{{ trans('m.name_ar') }}</th>
                    <th>{{ trans('m.name_en') }}</th>
                    <th class="mw-20 w-20">{{ trans('m.operations') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($specifications) && $specifications->count() > 0)
                    @foreach ($specifications as $specification)
                        <tr>
                            <td>{{ $specification->name_ar }}</td>
                            <td>{{ $specification->name_en }}</td>
                            <td>
                                @include('partials.actions.specification')
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{ Form::tablePagination($specifications) }}
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            dynamicDataTable('#dynamic-table');
        });
    </script>
@stop
