@extends('layouts.master')

@section('title', trans_title('nickname'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('nickname') !!}
@stop
{{ Form::pageHeader('nickname.add', 'nickname') }}
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
                @if (isset($nicknames) && $nicknames->count() > 0)
                    @foreach ($nicknames as $nickname)
                        <tr>
                            <td>{{ $nickname->name_ar }}</td>
                            <td>{{ $nickname->name_en }}</td>
                            <td>
                                @include('partials.actions.nickname')
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
    {{ Form::tablePagination($nicknames) }}
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            dynamicDataTable('#dynamic-table');
        });
    </script>
@stop
