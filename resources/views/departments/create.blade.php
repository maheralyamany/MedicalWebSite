@extends('layouts.master')

@section('title', trans_add('departments'))



@section('breadcrumbs')
    {!! Breadcrumbs::render('add.departments') !!}
@stop
{!! Form::formTitle(trans_add('departments'), 'fa fa-magic') !!}
@section('content')

    {{ Form::open(['route' => 'departments.store', 'class' => 'form-vertical']) }}
    @include('departments.form')
    {{ Form::close() }}
@stop
