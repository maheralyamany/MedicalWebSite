@extends('layouts.master')
@section('title', trans_title('drugs'))
@section('breadcrumbs')
{!! Breadcrumbs::render('drugs') !!}
@stop
{{ Form::pageHeader('drugs.create', 'drugs') }}
@section('content')



    <div class="table-responsive">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover no-footer" width="100%">
            <thead>
            <tr>
                <th>{{ trans('m.name_ar') }}</th>
                <th>{{ trans('m.name_en') }}</th>
                <th>{{ trans('m.description') }}</th>
                <th>{{ trans('m.drug_type') }}</th>
                <th>{{ trans('m.status') }}</th>
                    <th class="mw-20 w-20">{{ trans('m.operations') }}</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($drugs) &&  $drugs -> count() > 0)
                @foreach($drugs as $drug)
                    <tr>
                        <td>{{$drug  ->name_ar}}</td>
                        <td>{{$drug ->name_en}}</td>
                        <td>{{$drug ->description}}</td>
                        <td>{{$drug ->drugType->getTransName()}}</td>

                        <td>{{ $drug->getStatus() }}</td>
                        <td>
                            @include('partials.actions.drugs')
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

    </div>
    {{ Form::tablePagination($drugs) }}
@stop
@section('scripts')
    <script>
        $(document).ready(function () {
            dynamicDataTable('#dynamic-table');
        });
    </script>
@stop
