@extends('panelViews::mainTemplate')
@section('page-wrapper')

<div class="alert-box success">
	<h2>{{ \Lang::get('panel::fields.permissionDenied') }}</h2>
</div>

@stop
