@extends('layouts.master')
@section('title', trans_edit('nationality'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.nationality') !!}
@stop
{!! Form::formTitle(trans_edit('nationality'), 'fa fa-pencil') !!}
@section('content')
    {{ Form::model($nationality, ['route' => ['nationality.update', $nationality->id], 'class' => 'form-vertical', 'method' => 'PUT']) }}
    @include('nationality.form')
    {{ Form::close() }}
@stop
