@extends('layouts.master')
@section('title', trans_edit('drugs'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.drugs') !!}
@stop
{!! Form::formTitle(trans_edit('drugs'), 'fa fa-pencil') !!}
@section('content')
    {{ Form::model($drug, ['route' => ['drugs.update', $drug->id], 'class' => 'form-vertical', 'method' => ' POST']) }}
    @include('drugs.form')
    {{ Form::close() }}
@stop
