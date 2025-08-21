@extends('layouts.master')
@section('title', trans_show_details('users'))

@section('styles')
  {!! Html::style('public/assets/css/profile-info.css') !!}
@stop
@section('content')
@section('breadcrumbs')
    {!! Breadcrumbs::render('view.users') !!}
@stop
<div class="page-content">
    <div class="col-md-12">
        <div class="page-header">
            <h1><i class="menu-icon fa fa-image"></i> {{ $user->getFullName() }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 m-0 p-0">
            <div class="fileupload-preview thumbnail">
                <img id="avatar" alt="avatar"
                    src="{{ $user->photo != '' ? $user->photo : asset('images/male.png') }}" />
            </div>
        </div>
        <div class="col-md-10  m-0 p-0">
            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.name_ar') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $user->name_ar }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.name_en') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $user->name_en }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.phone') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $user->mobile }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans_vname('branch') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $user->branch->getTransName() }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.email') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $user->email }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.card_type') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $user->cardType->name_ar }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.id_card') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $user->id_card }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.address') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $user->address }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.birth_date') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $user->birth_date }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.gender') }} </div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $user->getGender() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
