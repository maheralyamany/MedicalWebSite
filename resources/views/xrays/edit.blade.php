@extends('layouts.master')
@section('title', trans_edit('xrays'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.xrays') !!}
@stop
{!! Form::formTitle(trans_edit('xrays'), 'fa fa-pencil') !!}
@section('content')
    {{ Form::model($xray, ['route' => ['xrays.update', $xray->id], 'class' => 'form-vertical', 'method' => ' POST']) }}
    @include('xrays.form')
    {{ Form::close() }}
@stop
