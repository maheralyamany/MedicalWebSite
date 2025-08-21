@extends('layouts.master')
@section('title', trans_add('services'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('add.services') !!}
@stop
{!! Form::formTitle(trans_add('services')) !!}
@section('content')
    {{ Form::open(['route' => 'services.store', 'class' => 'form-vertical']) }}
    @include('services.form')
    {{ Form::close() }}
@stop
