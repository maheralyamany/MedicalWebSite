@extends('layouts.master')
@section('title', trans_show_details('branch'))
@section('styles')
  {!! Html::style('public/assets/css/profile-info.css') !!}
@stop
@section('content')
@section('breadcrumbs')
    {!! Breadcrumbs::render('show.branch') !!}
@stop
<div class="page-content">
    <div class="col-md-12">
        <div class="page-header">
            <h5><i class="menu-icon fa fa-image"></i> {{ $branch->getTransName() }}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 m-0 p-0">
            <div class="fileupload-preview thumbnail">
                <img id="avatar" alt="avatar"
                    src="{{ $branch->getBranchLogo()}}" />
            </div>
        </div>
        <div class="col-md-10  m-0 p-0">
            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.name_ar') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $branch->name_ar }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.name_en') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $branch->name_en }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.phone') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $branch->mobile }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.email') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $branch->email }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.address') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $branch->address }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
