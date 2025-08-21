@extends('layouts.master')
@section('title', trans_add('nickname'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('add.nickname') !!}
@stop
{!! Form::formTitle(trans_add('nickname')) !!}
@section('content')
    {{ Form::open(['route' => 'nickname.store', 'class' => 'form-vertical']) }}
    @include('nickname.form')
    {{ Form::close() }}
@stop
