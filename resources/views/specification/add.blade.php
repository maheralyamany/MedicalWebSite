@extends('layouts.master')
@section('title', trans_add('specification'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('add.specification') !!}
@stop
{!! Form::formTitle(trans_add('specification')) !!}
@section('content')
    {{ Form::open(['route' => 'specification.store', 'class' => 'form-vertical']) }}
    @include('specification.form')
    {{ Form::close() }}
@stop
