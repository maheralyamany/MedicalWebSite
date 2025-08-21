@extends('layouts.master')
@section('title', trans_add('branch'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('add.branch') !!}
@stop
{!! Form::formTitle(trans_add('branch'), 'fa fa-magic') !!}
@section('content')
    {{ Form::open(['route' => 'branch.store', 'class' => 'form-vertical', 'files' => true]) }}
    @include('branch.form')
    {{ Form::close() }}
@stop
