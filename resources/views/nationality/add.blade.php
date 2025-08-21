@extends('layouts.master')
@section('title', trans_add('nationality'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('add.nationality') !!}
@stop
{!! Form::formTitle(trans_add('nationality')) !!}
@section('content')
    {{ Form::open(['route' => 'nationality.store', 'class' => 'form-vertical']) }}
    @include('nationality.form')
    {{ Form::close() }}
@stop
