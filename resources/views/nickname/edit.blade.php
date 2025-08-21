@extends('layouts.master')
@section('title', trans_edit('nickname'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.nickname') !!}
@stop
{!! Form::formTitle(trans_edit('nickname'), 'fa fa-pencil') !!}
@section('content')
    {{ Form::model($nickname, ['route' => ['nickname.update', $nickname->id], 'class' => 'form-vertical', 'method' => 'PUT']) }}
    @include('nickname.form')
    {{ Form::close() }}
@stop
