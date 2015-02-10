<link href="../../../workbench/sadra/pack1/src/public/css/rapyd-styles.css" type="text/css" >
@extends('panelViews::mainTemplate')
@section('page-wrapper')


{{ $filter }}

<a href="{{ url('panel/'.$current_entity.'/export/excel') }}">Export As Excel</a>

{{ $grid }}

@stop   
