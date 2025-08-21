@extends('layouts.master')
@section('title', trans_edit('services'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.services') !!}
@stop
{!! Form::formTitle(trans_edit('services'), 'fa fa-pencil') !!}
@section('content')
    {{ Form::model($item, ['route' => ['services.update', $item->id], 'class' => 'form-vertical']) }}
    @include('services.form')
    {{ Form::close() }}
@stop
