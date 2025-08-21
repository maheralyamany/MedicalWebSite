@extends('layouts.master')
@section('title', trans_title('nationality'))
@section('breadcrumbs')
    {!! Breadcrumbs::render('nationality') !!}
@stop
{{ Form::pageHeader('nationality.add', 'nationality') }}
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
                @if (isset($nationalities) && $nationalities->count() > 0)
                    @foreach ($nationalities as $item)
                        <tr>
                            <td>{{ $item->name_ar }}</td>
                            <td>{{ $item->name_en }}</td>
                            <td>
                                @include('partials.actions.nationality')
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
       
    </div>
    {{ Form::tablePagination($nationalities) }}
@stop
@section('scripts')
<script>
  
    $(document).ready(function() {
        dynamicDataTable('#dynamic-table');
    });
</script>
@stop
