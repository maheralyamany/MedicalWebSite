@extends('layouts.master')
@section('title', trans_add('drugs'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('add.drugs') !!}
@stop
{!! Form::formTitle(trans_add('drugs')) !!}
@section('content')
    {{ Form::open(['route' => 'drugs.store', 'class' => 'form-vertical']) }}
    @include('drugs.form')
    {{ Form::close() }}
@stop
