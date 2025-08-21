@extends('layouts.master')
@section('title', trans_add('doctor'))
@section('styles-after')
    {!! Html::style('css/form.css') !!}
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('add.doctor') !!}
@stop
{!! Form::formTitle(trans_add('doctor')) !!}
@section('content')

    {{ Form::open(['route' => ['doctor.store'], 'class' => 'form-vertical', 'method' => 'post', 'files' => true]) }}

    @include('doctor.form')

    {{ Form::close() }}

@stop
