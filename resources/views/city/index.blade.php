@extends('layouts.master')
@section('title', trans_title('city'))
@section('breadcrumbs')
    {!! Breadcrumbs::render('city') !!}
@stop
{{ Form::pageHeader('city.add', 'city') }}
@section('content')


    <div class="table-responsive">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover no-footer" width="100%">
            <thead>
                <tr>
                    <th>{{ trans('m.name_ar') }}</th>
                    <th>{{ trans('m.name_en') }}</th>
                    <th class="mw-25 w-20">{{ trans('m.operations') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($citys) && $citys->count() > 0)
                    @foreach ($citys as $item)
                        <tr>
                            <td>{{ $item->name_ar }}</td>
                            <td>{{ $item->name_en }}</td>
                            <td>
                                @include('partials.actions.city')

                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
    {{ Form::tablePagination($citys) }}
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            dynamicDataTable('#dynamic-table');
        });
    </script>
@stop
