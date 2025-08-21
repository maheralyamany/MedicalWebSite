@extends('layouts.master')
@section('title', trans_title('users'))
@section('breadcrumbs')
    {!! Breadcrumbs::render('users') !!}
@stop
{{ Form::pageHeader('users.add', 'users') }}
@section('content')
    <div class="table-responsive">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover no-footer" width="100%" >
            <thead>
                <tr>
                    <th>{{ trans('m.name') }}</th>
                    <th>{{ trans('m.phone') }}</th>
                    <th>{{ trans_vname('branch') }}</th>
                    <th>{{ trans('m.user_type') }}</th>
                    <th>{{ trans('m.birth_date') }}</th>
                    <th>{{ trans('m.address') }}</th>
                    <th>{{ trans('m.status') }}</th>
                    <th class="mw-20 w-20">{{ trans('m.operations') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($users) && $users->count() > 0)
                    @foreach ($users as $user)
                        <tr id="{{$user->id}}">
                            <td><img src="{{ $user->getUserPhoto() }}" alt="maxSoft" class="avatar image-style p-1 mr-3 item-img col-aka d-md-inline"> {{ $user->getTransName() }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->branch->getTransName() }}</td>
                            <td>{{ $user->userGroup->name }}</td>
                            <td>{{ $user->birth_date }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ Form::statusToggleButton($user->id,'users.status',$user->status, $user->status,$user->isAdmin()) }}</td>
                            <td>
                                @include('partials.actions.user')
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{ Form::tablePagination($users) }}
@stop
@section('scripts')
    <script>


        $(document).ready(function() {
            dynamicDataTable('#dynamic-table');
        });
    </script>
@stop
