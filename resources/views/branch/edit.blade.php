@extends('layouts.master')

@section('title', trans_edit('branch'))



@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.branch') !!}
@stop
{!! Form::formTitle(trans_edit('branch'), 'fa fa-pencil') !!}
@section('content')

    {{ Form::model($branch, ['route' => ['branch.update', $branch->id], 'class' => 'form-vertical', 'files' => true]) }}
    @include('branch.form')
    {{ Form::close() }}
@stop
