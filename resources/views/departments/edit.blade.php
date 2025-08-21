@extends('layouts.master')

@section('title', trans_edit('departments'))



@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.departments') !!}
@stop
{!! Form::formTitle(trans_edit('departments'), 'fa fa-pencil') !!}
@section('content')

    {{ Form::model($item, ['route' => ['departments.update', $item->id], 'class' => 'form-vertical', 'files' => true]) }}
    @include('departments.form')
    {{ Form::close() }}
@stop
