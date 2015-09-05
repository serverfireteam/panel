@extends('panelViews::mainTemplate')
@section('page-wrapper')

    @if ($helper_message)
	<div>&nbsp;</div>
	<div class="alert alert-info">
		<h3 class="help-title">{{ trans('rapyd::rapyd.help') }}</h3>
		{{ $helper_message }}
	</div>
    @endif

    <p>
        {!! $edit !!}
    </p>
@stop
