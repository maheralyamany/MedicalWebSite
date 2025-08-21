@extends('layouts.master')
@section('title', trans_add('xrays'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('add.xrays') !!}
@stop
{!! Form::formTitle(trans_add('xrays')) !!}
@section('content')
    {{ Form::open(['route' => 'xrays.store', 'class' => 'form-vertical']) }}
    @include('xrays.form')
    {{ Form::close() }}
@stop
