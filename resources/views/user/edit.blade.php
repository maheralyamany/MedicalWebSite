@extends('layouts.master')

@section('title', trans_edit('users'))


@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.users') !!}
@stop
{!! Form::formTitle(trans_edit('users'), 'fa fa-pencil') !!}
@section('content')

    {{ Form::model($user, ['route' => ['users.update', $user->id], 'class' => 'form-vertical', 'method' => 'PUT', 'files' => true]) }}
    @include('user.form')
    {{ Form::close() }}
@stop
