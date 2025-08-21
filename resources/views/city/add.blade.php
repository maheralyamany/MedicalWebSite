@extends('layouts.master')

@section('title', trans_add('city'))



@section('breadcrumbs')
    {!! Breadcrumbs::render('add.city') !!}
@stop
{!! Form::formTitle(trans_add('city'), 'fa fa-magic') !!}
@section('content')

    {{ Form::open(['route' => 'city.store', 'class' => 'form-vertical']) }}
    @include('city.form')
    {{ Form::close() }}
@stop
