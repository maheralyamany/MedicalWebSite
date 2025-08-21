@extends('layouts.master')

@section('title', trans_edit('city'))



@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.city') !!}
@stop
{!! Form::formTitle(trans_edit('city'), 'fa fa-pencil') !!}
@section('content')

    {{ Form::model($city, ['route' => ['city.update', $city->id], 'class' => 'form-vertical', 'method' => 'PUT']) }}
    @include('city.form')
    {{ Form::close() }}
@stop
