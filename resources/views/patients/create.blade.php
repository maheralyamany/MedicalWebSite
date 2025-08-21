@extends('layouts.master')
@section('title', trans_add('patients'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('add.patients') !!}
@stop
{!! Form::formTitle(trans_add('patients')) !!}


@section('content')
    {{ Form::open(['route' => 'patients.store', 'class' => 'form-vertical', 'files' => true,'id'=>'save_patient_form']) }}
    @include('patients.form')
    {{ Form::close() }}
@stop
