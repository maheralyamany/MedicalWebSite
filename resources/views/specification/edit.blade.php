@extends('layouts.master')
@section('title', trans_edit('specification'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.specification') !!}
@stop
{!! Form::formTitle(trans_edit('specification'), 'fa fa-pencil') !!}
@section('content')
    {{ Form::model($specification, ['route' => ['specification.update', $specification->id], 'class' => 'form-vertical', 'method' => 'PUT']) }}
    @include('specification.form')
    {{ Form::close() }}
@stop
