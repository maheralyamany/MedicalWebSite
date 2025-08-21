@extends('layouts.master')
@section('title', trans_show_details('doctor'))
@section('styles')
  {!! Html::style('public/assets/css/profile-info.css') !!}
@stop


@section('content')
@section('breadcrumbs')
    {!! Breadcrumbs::render('view.doctor') !!}
@stop
<div class="page-content">
    <div class="col-md-12">
        <div class="page-header">

        </div>
    </div>
    <div class="row">
        <div class="col-md-2 m-0 p-0">
            <div class="fileupload-preview thumbnail">
                <img id="avatar" alt="avatar"
                    src="{{ $doctor->user->photo != '' ? $doctor->user->photo : asset('images/male.png') }}" />
            </div>
        </div>
        <div class="col-md-10  m-0 p-0">
            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.name_ar') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->user->name_ar }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.name_en') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->user->name_en }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.phone') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->user->mobile }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans_vname('branch') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->user->branch->getTransName() }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.email') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->user->email }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.card_type') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->user->cardType->name_ar }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.id_card') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->user->id_card }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.address') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->user->address }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.birth_date') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->user->birth_date }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.gender') }} </div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->user->getGender() }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans_vname('specification') }}</div>
                    <div class="profile-info-value">
                        <span
                            class="editable">{{ $doctor->specification->getTransName() }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans_vname('nickname') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->nickname->getTransName() }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans_vname('nationality') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->nationality->getTransName() }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.consulting_price') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->consulting_price }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">{{ trans('m.salary') }}</div>
                    <div class="profile-info-value">
                        <span class="editable">{{ $doctor->salary }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
