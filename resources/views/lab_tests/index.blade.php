@extends('layouts.master')
@section('title', trans_title('lab_tests'))
@section('breadcrumbs')
    {!! Breadcrumbs::render('lab_tests') !!}
@stop
{{ Form::pageHeader('lab_tests.create', 'lab_tests') }}
@section('content')

    

    <div class="table-responsive">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover no-footer" width="100%">
            <thead>
            <tr>
                <th>{{ trans('m.name_ar') }}</th>
                <th>{{ trans('m.name_en') }}</th>
                <th>{{ trans('m.test_time') }}</th>
                <th>{{ trans('m.price') }}</th>
                <th>{{ trans('m.status') }}</th>
                    <th class="mw-20 w-20">{{ trans('m.operations') }}</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($lab_tests) &&  $lab_tests -> count() > 0)
                @foreach($lab_tests as $lab_test)
                    <tr>
                        <td>{{$lab_test  ->name_ar}}</td>
                        <td>{{$lab_test ->name_en}}</td>
                        <td>{{$lab_test ->test_time}}</td>
                        <td>{{$lab_test ->price}}</td>
                      
                        <td>{{ $lab_test->getStatus() }}</td>
                        <td>
                            @include('partials.actions.lab_tests')
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
       
    </div>
    {{ Form::tablePagination($lab_tests) }}
@stop
@section('scripts')
    <script>
        $(document).ready(function () {
            dynamicDataTable('#dynamic-table');
        });
    </script>
@stop
