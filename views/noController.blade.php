@extends('panelViews::master')
@section('bodyClass')
dashboard
@stop
@section('body')


@if(Session::has('message'))
    <div class="alert-box success">
        <h2>{{ Session::get('message') }}</h2>
    </div>
@endif
   

@stop