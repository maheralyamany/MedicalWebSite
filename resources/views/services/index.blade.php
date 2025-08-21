@extends('layouts.master')
@section('title', trans_title('services'))
@section('breadcrumbs')
    {!! Breadcrumbs::render('services') !!}
@stop

{{ Form::pageHeader('services.create', 'services') }}
@section('content')





    <div class="table-responsive">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover no-footer" width="100%">
            <thead>
                <tr>
                    <th>{{ trans('m.item_name') }}</th>
                    <th>{{ trans_vname('departments') }}</th>
                    <th>{{ trans('m.service_type') }}</th>
                    <th>{{ trans('m.price') }}</th>
                    <th>{{ trans('m.status') }}</th>
                    <th class="mw-25 w-25">{{ trans('m.operations') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($services) && $services->count() > 0)
                    @foreach ($services as $item)
                        <tr>
                            <td>{{ $item->service_name }}</td>
                            <td>{{ $item->department->getTransName() }}</td>
                            <td>{{ $item->getIsFree() }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->getStatus() }}</td>
                            <td>
                                @include('partials.actions.services')
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
    {{ Form::tablePagination($services) }}
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            dynamicDataTable('#dynamic-table');
        });
    </script>
@stop
