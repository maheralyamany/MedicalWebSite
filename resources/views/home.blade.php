@extends('layouts.master')
@section('title', trans('m.home'))
@section('styles-after')
    {!! Html::style('public/assets/css/infobox.css') !!}
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}
@stop
{!! Form::formTitle(trans('m.home'), 'fa fa-dashboard') !!}
@section('content')
    <div class="row">
        <div class="col-12  d-flex justify-content-center">
            <form class="d-flex flex-wrap" action="{{ route('admin.search') }}" method="GET">
                <div class="form-group has-float-label mx-2">
                    <input class="form-control " name="queryStr" placeholder="{{ trans('m.search_placeholder') }}">
                </div>
                <div class="form-group has-float-label mx-2">
                    <select class="form-control" name="type_id">
                        <option value="doctor"> {{ trans_title('doctor') }}</option>
                        <option value="branch">{{ trans_title('branch') }}</option>
                        <option value="users">{{ trans_title('users') }}</option>
                    </select>
                </div>
                <div class="form-group has-float-label mx-2">
                    <button type="submit" class="btn btn-success form-control "><i class="fa fa-search"></i>
                        {{ trans('m.search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12 infobox-container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 my-3">
                    <div class="infobox d-flex infobox-blue shadowe">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-user-md"></i>
                        </div>
                        <div class="infobox-data">
                            <span class="infobox-data-number">{{ $activeDoctorsCount }}</span>
                            <div class="infobox-content">ألاطباء المفعلين</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 my-3">
                    <div class="infobox d-flex infobox-blue shadowe">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-user-md"></i>
                        </div>
                        <div class="infobox-data">
                            <span class="infobox-data-number">{{ $activeUsersCount }}</span>
                            <div class="infobox-content">المستخدمين المفعلين</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 my-3">
                    <div class="infobox d-flex infobox-pink shadowe">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>
                        <div class="infobox-data">
                            <span class="infobox-data-number">{{ $usersCount }}</span>
                            <div class="infobox-content">المستخدمين</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
