@extends('layouts.master')
@section('title', trans_edit('doctor'))
@section('styles-after')
    {!! Html::style('css/form.css') !!}
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.doctor') !!}
@stop
{!! Form::formTitle(trans_edit('doctor'), 'fa fa-pencil') !!}
@section('content')
    {{ Form::model($doctor, ['route' => ['doctor.update', $doctor->id], 'class' => 'form-vertical', 'method' => 'post', 'files' => true]) }}
    @include('doctor.form')
    {{ Form::close() }}
@stop
