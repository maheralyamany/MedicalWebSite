@extends('layouts.master')

@section('title', trans_add('users'))



@section('breadcrumbs')
    {!! Breadcrumbs::render('add.users') !!}

@stop
{!! Form::formTitle(trans_add('users'), 'fa fa-magic') !!}
@section('content')


    {{ Form::open(['route' => ['users.store'], 'class' => 'form-vertical', 'method' => 'post', 'files' => true]) }}
    @include('user.form')
    {{ Form::close() }}

@stop
