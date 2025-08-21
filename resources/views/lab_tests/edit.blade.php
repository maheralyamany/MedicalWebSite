@extends('layouts.master')

@section('title', trans_edit('lab_tests'))



@section('breadcrumbs')
    {!! Breadcrumbs::render('edit.lab_tests') !!}
@stop
{!! Form::formTitle(trans_edit('lab_tests'), 'fa fa-pencil') !!}
@section('content')



    {{ Form::model($lab_test, ['route' => ['lab_tests.update', $lab_test->id], 'class' => 'form-vertical', 'method' => ' POST']) }}
    @include('lab_tests.form')
    {{ Form::close() }}


@stop
