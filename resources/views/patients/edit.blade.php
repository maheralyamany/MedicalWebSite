@extends('layouts.master')
@section('title', trans_edit('patients'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.patients') !!}
@stop
{!! Form::formTitle(trans_edit('patients'), 'fa fa-pencil') !!}
@section('content')
    {{ Form::model($patient, ['route' => 'patients.update', 'class' => 'form-vertical', 'files' => true,'id'=>'save_patient_form']) }}
    @include('patients.form')
    {{ Form::close() }}
@stop
