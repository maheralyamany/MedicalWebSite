@extends('layouts.master')
@section('title', trans_add('lab_tests'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('add.lab_tests') !!}
@stop
{!! Form::formTitle(trans_add('lab_tests')) !!}
@section('content')
    {{ Form::open(['route' => 'lab_tests.store', 'class' => 'form-vertical']) }}
    @include('lab_tests.form')
    {{ Form::close() }}
@stop
