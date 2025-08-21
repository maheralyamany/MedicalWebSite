@extends('layouts.master')
@section('title', trans_title('branch'))
@section('breadcrumbs')
    {!! Breadcrumbs::render('branch') !!}
@stop

{{ Form::pageHeader('branch.create', 'branch') }}
@section('content')
    <div class="table-responsive">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover no-footer" width="100%">
            <thead>
                <tr>
                    <th>{{ trans('m.name_ar') }}</th>
                    <th>{{ trans('m.name_en') }}</th>
                    <th>{{ trans('m.mobile') }}</th>
                    <th>{{ trans('m.email') }}</th>
                    <th>{{ trans('m.address') }}</th>
                    <th>{{ trans('m.logo') }}</th>
                    <th>{{ trans('m.status') }}</th>
                    <th>{{ trans('m.operations') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($branches) && $branches->count() > 0)
                    @foreach ($branches as $branch)
                        <tr>
                            <td>{{ $branch->name_ar }}</td>
                            <td>{{ $branch->name_en }}</td>
                            <td>{{ $branch->mobile }}</td>
                            <td>{{ $branch->email }}</td>
                            <td>{{ $branch->address }}</td>
                              <td><img src="{{ $branch->getBranchLogo() }}" alt="maxSoft" class="avatar logo image-style p-1 item-img col-aka d-md-inline"/> </td>
                             <td>{{ Form::statusToggleButton($branch->id,'branch.status',$branch->status, $branch->status,$branches->count()==1) }}</td>
                            <td>
                                @include('partials.actions.branch')
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
    {{ Form::tablePagination($branches) }}

@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            dynamicDataTable('#dynamic-table');
        });
    </script>
@stop
